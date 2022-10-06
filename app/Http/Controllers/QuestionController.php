<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Traits\BaseResponse;
use App\Services\QuestionService;

class QuestionController extends Controller
{

    use BaseResponse;

    public $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService; 
    }

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

        $questions = $this->questionService->index();

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

        $question = $this->questionService->edit($id);
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
        $question = $this->questionService->update($request->all(), $id);
        if(!$question){
            return $this->sendError('Page not Found.',[], 404); 
        }

        return $this->sendResponse(new QuestionResource($question), 'Question Updated Successfully.');
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
        $question = $this->questionService->destroy($id);
        if(!$question){
            return $this->sendError('Question not Found.',[], 404); 
        }

        return $this->sendResponse(new QuestionResource($question), 'Question Deleted successfully.');
    }
}
