<?php

use App\Http\Controllers\ExercisesSetsController;
use App\Http\Controllers\InstructionsController;
use App\Http\Controllers\StudentsController;
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

$routes = function () {
    Route::group(['middleware' => ['auth:sanctum']],
        function () {
            Route::get('user', function (Request $request) {
                return $request->user();
            });
            Route::resource('exercises-set', ExercisesSetsController::class)->except(['create', 'edit']);
            Route::resource('instructions', InstructionsController::class)->except(['create', 'edit']);
            Route::resource('exercise-list', ExercisesListController::class)->except(['create', 'edit']);
            Route::resource('students', StudentsController::class)->only(['index', 'show']);
        }
    );

    Route::group(['prefix' => 'auth'],
        function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::post('registration', [AuthController::class, 'registration']);
        }
    );
};

Route::group(['prefix' => '{lang?}', 'where' => [ 'lang' => 'en|sk']], $routes);

$routes();
