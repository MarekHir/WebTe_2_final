<?php

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

Route::group(['middleware' => ['auth:sanctum']],
    function () {
        Route::get('user', function (Request $request) {
            return $request->user();
        });
        Route::group(['prefix' => 'teacher'], function () {
            Route::post('exercise-list', [ExercisesListController::class, 'store']);
        });
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
