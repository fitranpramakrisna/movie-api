<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MovieController;

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

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::get('/movies', [MovieController::class, 'index'])->name('index');
    Route::get('/movies/{id}', [MovieController::class, 'show']);
    Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('delete');
    Route::post('/movies', [MovieController::class, 'create']);
    Route::patch('/movies/{id}', [MovieController::class, 'update'])->name('update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');;