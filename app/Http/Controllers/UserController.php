<?php

namespace App\Http\Controllers;

use App\Traits\BaseResponse;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    use BaseResponse;

    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService; 
    }

    public function index()
    {
        $users = $this->userService->all();
        if(!count($users) > 0){
            return $this->sendResponse($users, 'Record is Empty.'); 
        }
        return $this->sendResponse($users, 'Record retrieved successfully.');
    }

    public function save(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->all());
        
        return $this->sendResponse($user, 'User Created Successfully.', 201);
        
    }

    public function edit($id)
    {
        $user = $this->userService->find($id);
        if(!$user){
            return $this->sendError('User not Found.', [], 404); 
        }
        return $this->sendResponse($user,'User retrieved Successfully.');
    }

    public function findUserCode($id)
    {
        $user = $this->userService->findUserCourse($id);
        if(!$user){
            return $this->sendError('User not Found.', [], 404); 
        }
        return $this->sendResponse($user,'User retrieved Successfully.');
    }

    public function update(Request $request, $id)
    {   
        $user = $this->userService->update($request->all(), $id);
        if(!$user){
            return $this->sendError('User not Found.',[], 404); 
        }
        return $this->sendResponse($user,'User Updated Successfully.');
    }

    public function delete($id)
    {
        $user = $this->userService->destroy($id);
        if(!$user){
            return $this->sendError('User not Found.',[],404); 
        }
        return $this->sendResponse($user,'User Deleted successfully.');
    }
}