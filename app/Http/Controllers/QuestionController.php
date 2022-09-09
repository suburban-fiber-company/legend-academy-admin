<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\QuestionOption  as Options;
use App\Models\Question;
use App\Http\Resources\QuestionResource;
use Illuminate\Http\Request;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use DB;

class QuestionController extends Controller
{

    use BaseResponse;

     /**
     * @OA\Get(
     *      path="/api/v1/questions",
     *      operationId="getQuestionList",
     *      tags={"QuizQuestion"},
     *      summary="Get list of questions",
     *      description="Returns list of questions",
     *      security={ {"bearer": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/QuestionResource"
     *          ),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        //

        $questions = Question::all();

        return $this->sendResponse(QuestionResource::collection($questions), 'Question Retrieved Successfully.');
    }

    /**
     * @OA\Get(
     *      path="/api/v1/questions/{id}",
     *      operationId="getQuestionById",
     *      tags={"QuizQuestion"},
     *      summary="Get Question information",
     *      description="Returns question data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Question id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Question")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function edit($id)

    {
        //

        $question = Question::find($id);
        if (!$question) {
            return $this->sendError('Question not Found.', [], 404);
        }
        return $this->sendResponse(new QuestionResource($question), 'Question Retrieved Successfully.');
    }

    /**
     * @OA\Put(
     *      path="/api/v1/questions/{id}",
     *      operationId="updateQuestion",
     *      tags={"QuizQuestion"},
     *      summary="Update existing question",
     *      description="Returns updated question data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Question id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateQuestionRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Question")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function update(UpdateQuestionRequest $request, $id)
    {
        //
        try {
            $question = Question::find($id);
            $$question->update($request->all());
            $question = Question::find($id);

            DB::commit();
            return $this->sendResponse(new QuestionResource($question), 'Question Updated Successfully.');
        } catch (\Exception $e) {

            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error' => $e->getMessage()], 500)
            );
        }
    }
    
    /**
     * @OA\Delete(
     *      path="/api/v1/questions/{id}",
     *      operationId="deleteQuestion",
     *      tags={"QuizQuestion"},
     *      summary="Delete existing question",
     *      description="Deletes a record and returns no success message",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Question id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function destroy($id)
    {
        //

        $question = Question::find($id);
       
        if (!$question) {
            return $this->sendError('question not Found.', [], 404);
        }
        $question->delete();
        return $this->sendResponse(new QuestionResource($question), 'Question Deleted successfully.');
    }
}
