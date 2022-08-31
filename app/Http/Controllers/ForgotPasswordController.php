<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\BaseResponse;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{   
    use  BaseResponse;

    public function forgot() {

        $credentials = request()->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($credentials);

        return $status === Password::RESET_LINK_SENT
            ?  $this->sendResponse([], 'Reset password link sent to your email ')
            : $this->sendError('Record not found.');
       
    }

    public function reset(Request $request) {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                
                $user->tokens->each(function($token, $key){
                    $token->delete();
                });

                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                //event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
            ?  $this->sendResponse([], 'Password Reset Successfully')
            : $this->sendError('This token have expired');
    }

}
