<?php

namespace App\Services;

use App\Models\Question;
use App\Http\Resources\QuestionResource;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuestionService 
{

    use BaseResponse;

    public function index()
    {
        //

        $questions = Question::all();

        return QuestionResource::collection($questions);
    }

    public function edit($id)

    {
        //

        $question = Question::find($id);
        if (is_null($question)) {
            return false;
        }
        
        return new QuestionResource($question);
    }

    public function update($data, $id)
    {
        //
        try {
            $question = Question::find($id);
            $question->update($data);
            $question = Question::find($id);

            return new QuestionResource($question);
        } catch (\Exception $e) {

            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error' => $e->getMessage()], 500)
            );
        }
    }

    public function destroy($id)
    {
        //

        $question = Question::find($id);
        if (is_null($question)) {
            return false;
        }
        $question->delete();

        return new QuestionResource($question);
    }
}