<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->put('user/{user}/online', [App\Http\Controllers\Admin\UsersController::class, 'online']);
Route::middleware('auth:api')->put('user/{user}/offline', [App\Http\Controllers\Admin\UsersController::class, 'offline']);
Route::middleware('auth:api')->put('user/{user}/active-attendance', [App\Http\Controllers\Admin\UsersController::class, 'activeAttendance']);