<?php

namespace App\Http\Controllers;

use App\Traits\BaseResponse;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use Illuminate\Http\Request;
use App\Services\UnitService;

class UnitController extends Controller
{
    use BaseResponse;

    public $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService; 
    }

      /**
     * @OA\Get(
     *      path="/api/v1/units",
     *      operationId="getUnitsList",
     *      tags={"Units"},
     *      summary="Get list of department units",
     *      description="Returns list of department units",
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
     *                  example="units Retrieved Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *              type="array",
     *               @OA\Items(ref="#/components/schemas/Unit")
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
        $units = $this->unitService->all();
        if(!count($units) > 0){
            return $this->sendResponse($units, 'Record is Empty.'); 
        }
        return $this->sendResponse($units, 'Record retrieved successfully.');
    }

     /**
     * @OA\Post(
     *      path="/api/v1/units",
     *      operationId="storeUnit",
     *      tags={"Units"},
     *      summary="Store new department unit",
     *      description="Returns department unit data",
     *      security={ {"bearer": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUnitRequest")
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
     *                  example="Unit created successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *              ref="#/components/schemas/Unit"
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

    public function save(StoreUnitRequest $request)
    {
        
        $unit = $this->unitService->store($request->all());
        
        return $this->sendResponse($unit, 'Unit Created Successfully.', 201);
        
    }

    /**
     * @OA\Get(
     *      path="/api/v1/units/{id}",
     *      operationId="getUnitById",
     *      tags={"Units"},
     *      summary="Get department unit information",
     *      description="Returns department unit data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Unit id",
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
     *                  example="Unit Retrieved Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *               ref="#/components/schemas/Unit"
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
        $unit = $this->unitService->find($id);
        if(!$unit){
            return $this->sendError('Unit not Found.', [], 404); 
        }
        return $this->sendResponse($unit,'Unit retrieved Successfully.');
    }

     /**
     * @OA\Put(
     *      path="/api/v1/units/{id}",
     *      operationId="updateUnit",
     *      tags={"Units"},
     *      summary="Update existing department unit",
     *      description="Returns updated department unit data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Unit id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUnitRequest")
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
     *                  example="Page Updated Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *               ref="#/components/schemas/Unit"
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

    public function update(UpdateUnitRequest $request, $id)
    {   
        $unit = $this->unitService->update($request->all(), $id);
        if(!$unit){
            return $this->sendError('Unit not Found.',[], 404); 
        }
        return $this->sendResponse($unit,'Unit Updated Successfully.');
    }

      /**
     * @OA\Delete(
     *      path="/api/v1/units/{id}",
     *      operationId="deleteUnit",
     *      tags={"Units"},
     *      summary="Delete existing department unit",
     *      description="Deletes a record and returns no data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Unit id",
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
     *                  example="Unit Deleted Successfully"
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
        $unit = $this->unitService->destroy($id);
        if(!$unit){
            return $this->sendError('Unit not Found.',[],404); 
        }
        return $this->sendResponse($unit,'Unit Deleted successfully.');
    }
}
