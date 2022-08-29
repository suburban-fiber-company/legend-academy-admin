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
     * Register api
     *  @param  \App\Http\Requests\StorePostRequest  $request
     * 
     * @return \Illuminate\Http\Response
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
