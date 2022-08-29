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

    public function index()
    {
        $modules = $this->moduleService->all();
        if (!count($modules) > 0) {
            return $this->sendResponse($modules, 'Record is Empty.');
        }
        return $this->sendResponse($modules, 'Record retrieved successfully.');
    }

    public function save(StoreModuleRequest $request)
    {

        $module = $this->moduleService->store($request->all());

        return $this->sendResponse($module, 'Module Created Successfully.', 201);
    }

    public function edit($id)
    {
        $module = $this->moduleService->find($id);
        if (!$module) {
            return $this->sendError('Module not Found.', [], 404);
        }
        return $this->sendResponse($module, 'Module retrieved Successfully.');
    }

    public function update(Request $request, $id)
    {
        $module = $this->moduleService->update($request->all(), $id);
        if (!$module) {
            return $this->sendError('Module not Found.', [], 404);
        }
        return $this->sendResponse($module, 'Module Updated Successfully.');
    }

    public function delete($id)
    {
        $module = $this->moduleService->destroy($id);
        if (!$module) {
            return $this->sendError('Module not Found.', [], 404);
        }
        return $this->sendResponse($module, 'Module Delete successfully.');
    }
}
