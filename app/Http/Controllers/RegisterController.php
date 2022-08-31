<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Traits\BaseResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash; 

class RegisterController extends Controller
{
    use BaseResponse;

     /**
     * @OA\Post(
     *      path="/api/v1/register",
     *      operationId="Registration",
     *      tags={"Auth"},
     *      summary="Register a new user",
     *      description="Returns user data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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

    public function register(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $user = User::create($data);

            $success['token'] =  $user->createToken('MyApp')->accessToken;

            return $this->sendResponse($success, 'Registration successfully.');
        } catch (\Exception $e) {
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error' => $e->getMessage()], 500)
            );
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     *      path="/api/v1/login",
     *      operationId="Login",
     *      tags={"Auth"},
     *      summary="Login a user",
     *      description="Returns user data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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

    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] =  $user->toArray();

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'incorrect email/password'], 401);
        }
    }
}
