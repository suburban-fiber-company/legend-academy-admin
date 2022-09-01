<?php

namespace App\Http\Controllers;

use App\Traits\BaseResponse;
use App\Http\Requests\StoreDepartmentRequest;
use Illuminate\Http\Request;
use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    use BaseResponse;

    public $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService; 
    }

    /**
     * @OA\Get(
     *      path="/api/v1/departments",
     *      operationId="getDepartmentsList",
     *      tags={"Departments"},
     *      summary="Get list of department",
     *      description="Returns list of departments",
     *      security={ {"bearer": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DepartmentResource"
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
        $departments = $this->departmentService->all();
        if(!count($departments) > 0){
            return $this->sendResponse($departments, 'Record is Empty.'); 
        }
        return $this->sendResponse($departments, 'Record retrieved successfully.');
    }

    /**
     * @OA\Post(
     *      path="/api/v1/departments",
     *      operationId="storeDepartment",
     *      tags={"Departments"},
     *      summary="Store new department",
     *      description="Returns department data",
     *      security={ {"bearer": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreDepartmentRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Department")
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
    public function save(StoreDepartmentRequest $request)
    {
   
        $department = $this->departmentService->store($request->all());
        
        return $this->sendResponse($department, 'Department Created Successfully.', 201);
        
    }

       /**
     * @OA\Get(
     *      path="/api/v1/departments/{id}",
     *      operationId="getDepartmentById",
     *      tags={"Departments"},
     *      summary="Get Department information",
     *      description="Returns departments data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Department")
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
        $department = $this->departmentService->find($id);
        if(! $department ){
            return $this->sendError('Department not Found.', [], 404); 
        }
        return $this->sendResponse( $department ,' Department  retrieved Successfully.');
    }

    /**
     * @OA\Put(
     *      path="/api/v1/departments/{id}",
     *      operationId="updateDepartment",
     *      tags={"Departments"},
     *      summary="Update existing department",
     *      description="Returns updated department data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Department id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateDepartmentRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Department")
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

    public function update(Request $request, $id)
    {   
        $department = $this->departmentService->update($request->all(), $id);
        if(!$department ){
            return $this->sendError(' Department  not Found.',[], 404); 
        }
        return $this->sendResponse( $department ,' Department  Updated Successfully.');
    }

      /**
     * @OA\Delete(
     *      path="/api/v1/departments/{id}",
     *      operationId="deleteDepartment",
     *      tags={"Departments"},
     *      summary="Delete existing department",
     *      description="Deletes a record and returns no success message",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Department id",
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

    public function delete($id)
    {
        $department  = $this->departmentService->destroy($id);
        if(!$department ){
            return $this->sendError('Department  not Found.',[],404); 
        }
        return $this->sendResponse( $department ,'Department  Deleted successfully.');
    }
}