<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 
Route::controller(CourseController::class)->group(function () {
    Route::get('/v1/courses', 'index');
    Route::post('/v1/courses', 'save');
    Route::get('/v1/courses/{id}', 'edit');
    Route::put('/v1/courses/{id}', 'update');
    Route::delete('/v1/courses/{id}', 'delete');
    Route::get('/v1/courses-modules', 'courseModule');
    Route::get('/v1/courses/{id}/modules', 'findCourseModule');
});

Route::controller(ModuleController::class)->group(function () {
    Route::get('/v1/modules', 'index');
    Route::post('/v1/modules', 'save');
    Route::get('/v1/modules/{id}', 'edit');
    Route::put('/v1/modules/{id}', 'update');
    Route::delete('/v1/modules/{id}', 'delete');
});

Route::controller(PageController::class)->group(function () {
    Route::get('/v1/pages', 'index');
    Route::post('/v1/pages', 'save');
    Route::get('/v1/pages/{id}', 'edit');
    Route::put('/v1/pages/{id}', 'update');
    Route::delete('/v1/pages/{id}', 'delete');
});

Route::controller(RegisterController::class)->group(function () {
    Route::post('/v1/register', 'register');
    Route::post('/v1/login', 'login');
});
