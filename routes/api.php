<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::POST('/login', [AuthController::class, 'login']);
Route::POST('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('users', UserController::class);
    Route::PUT('/employee/contact', [UserController::class,'updateContact']);
});
