<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Http\Resources\QuizResource;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use DB;


class QuizService
{
    use BaseResponse;

    public function all()
    {
        $quizzes = Quiz::all();

        return QuizResource::collection($quizzes);
        
    }


    public function store($data)
    {   
        try{
            DB::beginTransaction();

            $quiz = Quiz::create($data);

            foreach($data['questions'] as $question) {
                $data = [
                    'question'=> $question['question'],
                    'correct_answer'=> $question['correct_answer'],
                    'quiz_id' => $quiz->id,
                ];

                $quizQuestion = Question::create($data);

                foreach($question['options'] as $option) {
                    $params = [
                        'question_id' => $quizQuestion->id,
                        'option' => $option,
                    ];

                    QuestionOption::create($params);
                }
            }
            
            DB::commit();

            $data = Quiz::find($quiz->id);

            return new QuizResource($data);

        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function update($data, $id)
    {   
        try{
            $quizzes =  Quiz::find($id);
            if (is_null($quizzes)) {
                return false;
            }
            $quizzes->update($data);

            return new QuizResource($quizzes);

        } catch (\Exception $e) {
            
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function find($id)
    {
        $quiz =  Quiz::find($id);
        if (is_null($quiz)) {
            return false;
        }
        
        return new QuizResource($quiz);
    }


    public function publish($course, $id)
    {
        $quiz =  Quiz::find($id);
        $quiz->update(['punlished'=>1]);

        return new QuizResource($quiz);
    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        if (is_null($quiz)) {
            return false;
        }
        $data = $quiz->delete();
        return $data;
        
    }
}