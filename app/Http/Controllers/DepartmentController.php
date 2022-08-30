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

    public function index()
    {
        $departments = $this->departmentService->all();
        if(!count($departments) > 0){
            return $this->sendResponse($departments, 'Record is Empty.'); 
        }
        return $this->sendResponse($departments, 'Record retrieved successfully.');
    }

    public function save(StoreDepartmentRequest $request)
    {
   
        $department = $this->departmentService->store($request->all());
        
        return $this->sendResponse($department, 'Department Created Successfully.', 201);
        
    }

    public function edit($id)
    {
        $department = $this->departmentService->find($id);
        if(! $department ){
            return $this->sendError('Department not Found.', [], 404); 
        }
        return $this->sendResponse( $department ,' Department  retrieved Successfully.');
    }

    public function update(Request $request, $id)
    {   
        $department = $this->departmentService->update($request->all(), $id);
        if(!$department ){
            return $this->sendError(' Department  not Found.',[], 404); 
        }
        return $this->sendResponse( $department ,' Department  Updated Successfully.');
    }

    public function delete($id)
    {
        $department  = $this->departmentService->destroy($id);
        if(!$department ){
            return $this->sendError('Department  not Found.',[],404); 
        }
        return $this->sendResponse( $department ,'Department  Deleted successfully.');
    }
}