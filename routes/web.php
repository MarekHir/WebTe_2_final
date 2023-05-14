<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LatexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(['setLang']);

Route::post('/changeLang', [LangController::class, 'changeLang'])->name('changeLang')->middleware(['setLang']);

//Route::get('/{lang}', [LangController::class, 'returnLang'])->middleware(['setLang']);

// Authentication Routes...
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/test',[TestController::class, 'index']);

// Latex parse files route
Route::get('latex/{name}', [LatexController::class, 'extractData'])->name('latex.extractData');
Route::get('latex', [LatexController::class, 'renderSite'])->name('latex.renderSite');
