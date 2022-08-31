<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Legend Academy API Documentation",
 *      version="1.0.0",
 *      description="Legend Pay API description",
 *      @OA\Contact(
 *          email="o.oyedele@suburbanfiberco.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     ),
 *     @OA\Server(
 *         url=L5_SWAGGER_CONST_HOST,
 *         description="Legend Pay API Dynamic API Server"
 *     ),
 *     @OA\Server(
 *         url="https://projects.dev/api/v1",
 *         description="Legend Pay API Server"
 *     ),
 *     @OA\SecurityScheme(
 *         type="http",
 *         description="Login with email and password to generate token",
 *         name="Bearer Token",
 *         in="header",
 *         scheme="bearer",
 *         bearerFormat="JWT",
 *         securityScheme="apiAuth",
 *     )
 * )
 */

class Controller extends BaseController
{   
     
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
