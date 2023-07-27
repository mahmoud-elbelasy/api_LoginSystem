<?php

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthLoginController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/register',[RegisterController::class,'CreateUser']);
Route::post('/auth/login',[AuthLoginController::class,'LoginUser']);

Route::get('/test-user', [HomeController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');