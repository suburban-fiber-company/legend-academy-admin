<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SupportTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        $userTypes = ['Admin', 'Editor', 'Super Admin'];
        
        if (in_array(Auth::user()->user_type, $userTypes)) {
            return $next($request);
        } 
        else {
            return response()->json(["error"=> "You don't have permission to view this page"]);
        }
    }
}
