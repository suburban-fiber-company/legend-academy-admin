<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateQuestionOptionsRequest;
use App\Models\QuestionOption as Options;
use App\Http\Resources\QuestionOptionResource;
use App\Traits\BaseResponse;
use App\Services\QuestionOptionService;

class QuestionsOptionsController extends Controller
{

    
    use BaseResponse;

    public $questionOptionService;

    public function __construct(QuestionOptionService $questionOptionService)
    {
        $this->questionOptionService = $questionOptionService; 
    }

    
     /**
     * @OA\Get(
     *      path="/api/v1/options/questions",
     *      operationId="getQuestionOptionList",
     *      tags={"QuizQuestionOption"},
     *      summary="Get list of question options",
     *      description="Returns list of question options",
     *      security={ {"bearer": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/QuestionOption")
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

        $options = $this->questionOptionService->index();

        return $this->sendResponse(QuestionOptionResource::collection($options), 'Options Retrieved Successfully.');
    }
     
    /**
     * @OA\Get(
     *      path="/api/v1/options/questions/{id}",
     *      operationId="getQuestionOptionsById",
     *      tags={"QuizQuestionOption"},
     *      summary="Get Question option information",
     *      description="Returns question option data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="QuestionOption ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/QuestionOption")
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
        $option = $this->questionOptionService->edit($id);
        if (!$option) {
            return $this->sendError('Option not Found.',[], 404);
        }

        return $this->sendResponse(new QuestionOptionResource($option), 'Option Retrived Successfully.');
    }

    /**
     * @OA\Put(
     *      path="/api/v1/options/questions/{id}",
     *      operationId="updateQuestionOption",
     *      tags={"QuizQuestionOption"},
     *      summary="Update existing question option",
     *      description="Returns updated question option data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="QuestionOption id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateQuestionOptionRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/QuestionOption")
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

    public function update(UpdateQuestionOptionsRequest $request, $id)
    {
        $option = $this->questionOptionService->update($request->all(), $id);
        if(!$option){
            return $this->sendError('Option not Found.',[], 404);  
        }

        return $this->sendResponse(new QuestionOptionResource($option), 'Question Option Updated Successfully.');
    }

    
    /**
     * @OA\Delete(
     *      path="/api/v1/options/questions/{id}",
     *      operationId="deleteQuestionOption",
     *      tags={"QuizQuestionOption"},
     *      summary="Delete existing question option",
     *      description="Deletes a record and returns no success message",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="QuestionOption id",
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

        $option = $this->questionOptionService->destroy($id);

        if(!$option){
            return $this->sendError('Option not Found.',[], 404); 
        }
        return $this->sendResponse(new QuestionOptionResource($option), 'Question Option Deleted Successfully.');
    }
}
