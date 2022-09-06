<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResultRequest;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Result;
use App\Models\Module;
use App\Http\Resources\ResultResource;
use App\Model\User;
use App\Models\UserOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use DB;

class ResultsController extends Controller
{

    use BaseResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $allResults = Result::orderBy('created_at', 'desc')->get();

        return $this->sendResponse(ResultResource::collection($allResults), 'Results Retrieved Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function save(Request $request)
    {
        try {
            DB::beginTransaction();

            $score = 0;
            $questionCount = 0;
            $questions = $request->questions;
            foreach ($questions as $question) {
                $option = QuestionOption::find($question['selected_option_id']);

                if ($option->correct == 1) {
                    $score++;
                }
                $questionCount++;
            }
            $module = Module::find($request->module_id);
            $data = [
                'user_id' => 1,
                'module_id'  => $request->module_id,
                'course_id' => $module->course_id,
                'correct_answers' => $score,
                'questions_count' => $questionCount,
            ];

            $result = Result::create($data);

            foreach ($questions as $question) {
                $data = [
                    'user_id' =>  $result->user_id,
                    'result_id' => $result->id,
                    'question_id' => $question['question_id'],
                    'course_id' => $module->course_id,
                    'module_id' => $request->module_id,
                    'option_id' => $question['selected_option_id'],

                ];
                UserOption::create($data);
            }
            DB::commit();

            $result = Result::find($result->id);
            return $this->sendResponse(new ResultResource($result), 'Result Saved Successfully.', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error' => $e->getMessage()], 500)
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResultRequest $request)
    {

        try {
            DB::beginTransaction();

            $score = 0;
            $questions = $request->option;

            foreach ($questions as $key => $value) {
                $question = Question::find($key);
                $userCorrectAnswers = 0;
                foreach ($value as $answerKey => $answerValue) {
                    if ($answerValue == 1) {
                        $userCorrectAnswers++;
                    } else {
                        $userCorrectAnswers--;
                    }
                }
                if ($question->correctOptionsCount() == $userCorrectAnswers) {
                    $score++;
                }
            }
            $result = new Result();
            $result->user_id = Auth::user()->id;
            $result->course_id = $request->course_id;
            $result->module_id = $request->module_id;
            $result->correct_answers = $score;
            $result->questions_count = count($request->question_id);
            $result->save();

            foreach ($questions as $key => $value) {
                foreach ($value as $answerKey => $answerValue) {
                    $userOption = new UserOption();
                    $result->user_id = Auth::user()->id;
                    $userOption->result_id = $result->id;
                    $userOption->question_id = $key;
                    $userOption->course_id = $request->course_id;
                    $userOption->module_id = $request->module_id;
                    $userOption->option_id = $answerKey;
                    $userOption->save();
                }
            }
            DB::commit();
            $result = Result::find($result->id);
            return $this->sendResponse(new ResultResource($result), 'Result Saved Successfully.', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error' => $e->getMessage()], 500)
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $result = Result::find($id);

        return $this->sendResponse(new ResultResource($result), 'Result Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $result = Result::find($id);

        return $this->sendResponse(new ResultResource($result), 'Result Retrieved Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
