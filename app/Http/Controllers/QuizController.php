<?php

namespace App\Http\Controllers;

use App\Traits\BaseResponse;
use App\Http\Requests\StoreQuizRequest;
use Illuminate\Http\Request;
use App\Services\QuizService;

class QuizController extends Controller
{
    //
    use BaseResponse;

    public $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService; 
    }

      /**
     * @OA\Get(
     *      path="/api/v1/quizzes",
     *      operationId="getQuizList",
     *      tags={"Quizzes"},
     *      summary="Get list of quiz",
     *      description="Returns list of quiz",
     *      security={ {"bearer": {} }},
     *     @OA\Parameter(
     *         name="bearer_token",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="message",
     *                  example="Quiz Retrieved Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/Quiz"
     *              )
     *          )
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
        $quizzes = $this->quizService->all();
        if(!count($quizzes) > 0){
            return $this->sendResponse($quizzes, 'Record is Empty.'); 
        }
        return $this->sendResponse($quizzes, 'Record retrieved successfully.');
    }

    /**
     * @OA\Post(
     *      path="/api/v1/quizzes",
     *      operationId="storeQuiz",
     *      tags={"Quizzes"},
     *      summary="Store new quiz",
     *      description="Returns quiz data",
     *      security={ {"bearer": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreQuizRequest")
     *      ),
     *     @OA\Parameter(
     *         name="bearer_token",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="message",
     *                  example="Quiz created successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *              ref="#/components/schemas/Quiz"
     *              )
     *          )
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

    public function save(StoreQuizRequest $request)
    {
        
        $quiz = $this->quizService->store($request->all());
        
        return $this->sendResponse($quiz, 'Quiz Created Successfully.', 201);
        
    }

     /**
     * @OA\Get(
     *      path="/api/v1/quizzes/{id}",
     *      operationId="getQuizById",
     *      tags={"Quizzes"},
     *      summary="Get Quiz information",
     *      description="Returns quiz data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Quiz id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *         name="bearer_token",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="message",
     *                  example="Quiz  Retrieved Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *              ref="#/components/schemas/Quiz"
     *              )
     *          )
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
        $quiz = $this->quizService->find($id);
        if(!$quiz){
            return $this->sendError('Quiz not Found.', [], 404); 
        }
        return $this->sendResponse($quiz,'Quiz retrieved Successfully.');
    }

      /**
     * @OA\Patch(
     *      path="/api/v1/publish-quiz/{id}",
     *      operationId="publishQuiz",
     *      tags={"Quizzes"},
     *      summary="Publish a quiz",
     *      description="Returns no data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Quiz id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
       *     @OA\Parameter(
     *         name="bearer_token",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="message",
     *                  example="Quiz Published Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *               example=null
     *              )
     *          )
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

    public function publish(Request $request, $id)
    {   
        $course = $this->courseService->publish($request->all(), $id);
        if(!$course){
            return $this->sendError('Course not Found.',[], 404); 
        }
        return $this->sendResponse($course,'Course Published Successfully.');
    }

    
    /**
     * @OA\Delete(
     *      path="/api/v1/quizzes/{id}",
     *      operationId="deleteQuiz",
     *      tags={"Quizzes"},
     *      summary="Delete existing course",
     *      description="Deletes a record and returns no data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Quiz id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *         name="bearer_token",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="message",
     *                  example="Quiz Deleted Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *               example=null
     *              )
     *          )
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

    public function delete($id)
    {
        $quiz = $this->quizService->destroy($id);
        if(!$quiz){
            return $this->sendError('Quiz not Found.',[],404); 
        }
        return $this->sendResponse($quiz,'Quiz Delete successfully.');
    }
}
