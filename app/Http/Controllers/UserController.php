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

      /**
     * @OA\Get(
     *      path="/api/v1/users",
     *      operationId="getUserList",
     *      tags={"Users"},
     *      summary="Get list of users",
     *      description="Returns list of users",
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
     *                  example="Users Retrieved Successfully"
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
     *               @OA\Items(ref="#/components/schemas/User")
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
        $users = $this->userService->all();
        if(!count($users) > 0){
            return $this->sendResponse($users, 'Record is Empty.'); 
        }
        return $this->sendResponse($users, 'Record retrieved successfully.');
    }

     /**
     * @OA\Post(
     *      path="/api/v1/users",
     *      operationId="storeUser",
     *      tags={"Users"},
     *      summary="Store new user",
     *      description="Returns user data",
     *      security={ {"bearer": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
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
     *                  example="User created successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *              ref="#/components/schemas/User"
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
    public function save(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->all());
        
        return $this->sendResponse($user, 'User Created Successfully.', 201);
        
    }

     /**
     * @OA\Get(
     *      path="/api/v1/users/{id}",
     *      operationId="getUserById",
     *      tags={"Users"},
     *      summary="Get User information",
     *      description="Returns user data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
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
     *                  example="User Retrieved Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *               ref="#/components/schemas/User"
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
        $user = $this->userService->find($id);
        if(!$user){
            return $this->sendError('User not Found.', [], 404); 
        }
        return $this->sendResponse($user,'User retrieved Successfully.');
    }

       /**
     * @OA\Get(
     *      path="/api/v1/users/{id}/courses",
     *      operationId="getUserCourseById",
     *      tags={"Users"},
     *      summary="Get User information",
     *      description="Returns user with courses data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
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
     *                  example="User Course Retrieved Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *              ref="#/components/schemas/UserCourse"
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

    public function findUserCourse($id)
    {
        $user = $this->userService->findUserCourse($id);
        if(!$user){
            return $this->sendError('User not Found.', [], 404); 
        }
        return $this->sendResponse($user,'User retrieved Successfully.');
    }

    /**
     * @OA\Put(
     *      path="/api/v1/users/{id}",
     *      operationId="updateUser",
     *      tags={"Users"},
     *      summary="Update existing user",
     *      description="Returns updated user data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest")
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
     *                  example="User Updated Successfully"
     *             ),
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  description="success",
     *                  example=True
     *             ),
     *             @OA\Property(
     *              property="data",
     *               ref="#/components/schemas/User"
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

    public function update(Request $request, $id)
    {   
        $user = $this->userService->update($request->all(), $id);
        if(!$user){
            return $this->sendError('User not Found.',[], 404); 
        }
        return $this->sendResponse($user,'User Updated Successfully.');
    }

     /**
     * @OA\Delete(
     *      path="/api/v1/users/{id}",
     *      operationId="deleteUser",
     *      tags={"Users"},
     *      summary="Delete existing user",
     *      description="Deletes a record and returns no success message",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
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
     *                  example="User Deleted Successfully"
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
        $user = $this->userService->destroy($id);
        if(!$user){
            return $this->sendError('User not Found.',[],404); 
        }
        return $this->sendResponse($user,'User Deleted successfully.');
    }
}