<?php

namespace App\Http\Controllers;

use App\Traits\BaseResponse;
use App\Http\Requests\StoreModuleRequest;
use Illuminate\Http\Request;
use App\Services\ModuleService;

class ModuleController extends Controller
{
    //
    use BaseResponse;

    public $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

     /**
     * @OA\Get(
     *      path="/api/v1/modules",
     *      operationId="getModulesList",
     *      tags={"Modules"},
     *      summary="Get list of module",
     *      description="Returns list of modules",
     *      security={ {"bearer": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ModuleResource"
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
        $modules = $this->moduleService->all();
        if (!count($modules) > 0) {
            return $this->sendResponse($modules, 'Record is Empty.');
        }
        return $this->sendResponse($modules, 'Record retrieved successfully.');
    }

    /**
     * @OA\Post(
     *      path="/api/v1/modules",
     *      operationId="storeModule",
     *      tags={"Modules"},
     *      summary="Store new course module",
     *      description="Returns course module data",
     *      security={ {"bearer": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreModuleRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Module")
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
    public function save(StoreModuleRequest $request)
    {

        $module = $this->moduleService->store($request->all());

        return $this->sendResponse($module, 'Module Created Successfully.', 201);
    }

       /**
     * @OA\Get(
     *      path="/api/v1/modules/{id}",
     *      operationId="getModuleById",
     *      tags={"Modules"},
     *      summary="Get Module information",
     *      description="Returns modules data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Module id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Module")
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
        $module = $this->moduleService->find($id);
        if (!$module) {
            return $this->sendError('Module not Found.', [], 404);
        }
        return $this->sendResponse($module, 'Module retrieved Successfully.');
    }

     /**
     * @OA\Put(
     *      path="/api/v1/modules/{id}",
     *      operationId="updateModule",
     *      tags={"Modules"},
     *      summary="Update existing module",
     *      description="Returns updated module data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Module id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateModuleRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Module")
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
        $module = $this->moduleService->update($request->all(), $id);
        if (!$module) {
            return $this->sendError('Module not Found.', [], 404);
        }
        return $this->sendResponse($module, 'Module Updated Successfully.');
    }

    
      /**
     * @OA\Delete(
     *      path="/api/v1/modules/{id}",
     *      operationId="deleteModule",
     *      tags={"Departments"},
     *      summary="Delete existing module",
     *      description="Deletes a record and returns no success message",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Module id",
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
        $module = $this->moduleService->destroy($id);
        if (!$module) {
            return $this->sendError('Module not Found.', [], 404);
        }
        return $this->sendResponse($module, 'Module Delete successfully.');
    }
}
