<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionsOptionsController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\UnitController;

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
        Route::patch('/v1/publish-course/{id}', 'publish');
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

    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/v1/departments', 'index');
        Route::post('/v1/departments', 'save');
        Route::get('/v1/departments/{id}', 'edit');
        Route::put('/v1/departments/{id}', 'update');
        Route::delete('/v1/departments/{id}', 'delete');
    });

    Route::controller(UnitController::class)->group(function () {
        Route::get('/v1/units', 'index');
        Route::post('/v1/units', 'save');
        Route::get('/v1/units/{id}', 'edit');
        Route::put('/v1/units/{id}', 'update');
        Route::delete('/v1/units/{id}', 'delete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/v1/users', 'index');
        Route::post('/v1/users', 'save');
        Route::get('/v1/users/{id}', 'edit');
        Route::put('/v1/users/{id}', 'update');
        Route::delete('/v1/users/{id}', 'delete');
        Route::get('/v1/user-course', 'userCourse');
        Route::get('/v1/users/{id}/courses', 'findUserCourse');
    });

    Route::controller(QuestionController::class)->group(function () {
        Route::get('/v1/questions', 'index');
        Route::post('/v1/questions', 'store');
        Route::get('/v1/questions/{id}', 'edit');
        Route::put('/v1/questions/{id}', 'update');
        Route::delete('/v1/questions/{id}', 'destroy');
    });

    Route::controller(QuestionsOptionsController::class)->group(function () {
        Route::get('/v1/options/questions', 'index');
        Route::post('/v1/options/questions', 'store');
        Route::put('/v1/options/questions/{id}', 'update');
        Route::get('/v1/options/questions/{id}', 'edit');
        Route::delete('/v1/options/questions/{id}', 'destroy');
    });

    Route::controller(ResultsController::class)->group(function () {
        Route::get('/v1/results', 'index');
        Route::post('/v1/results', 'store');
        Route::get('/v1/results/{id}', 'show');
    });


Route::controller(RegisterController::class)->group(function () {
    Route::post('/v1/register', 'register');
    Route::post('/v1/login', 'login');
});

