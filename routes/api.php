<?php

use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\InstructionsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExercisesListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::localized(function () {
    Route::group(['middleware' => ['auth:sanctum']],
        function () {
            Route::get('user', function (Request $request) {
                return $request->user();
            });

            // TODO: allow only implemented methods
            Route::group(['prefix' => 'dashboard'], function (){
                Route::get('student', [DashboardsController::class, 'student']);
                Route::get('teacher', [DashboardsController::class, 'teacher']);
                Route::get('admin', [DashboardsController::class, 'admin']);
            });
            Route::get('instructions/{instruction}/pdf', [ExportsController::class, 'pdf']);
            Route::get('students/csv', [ExportsController::class, 'csv']);
            Route::resource('instructions', InstructionsController::class)->except(['create', 'edit']);
            Route::resource('exercises-list', ExercisesListController::class)->except(['create', 'edit']);
            Route::resource('students', StudentsController::class)->only(['index', 'show']);
            Route::get('users/{user}', [UsersController::class, 'show']);
            Route::post('users/{user}', [UsersController::class, 'update']);
            Route::resource('exercises', ExercisesController::class)->except(['create', 'edit', 'destroy']);
        }
    );

    Route::group(['prefix' => 'auth'],
        function () {
            Route::get('user', [AuthController::class, 'current_user'])->middleware('auth:sanctum');
            Route::post('login', [AuthController::class, 'login']);
            Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::post('registration', [AuthController::class, 'registration']);
        }
    );
});

