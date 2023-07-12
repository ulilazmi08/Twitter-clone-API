<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetController;
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

Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/tweet',[TweetController::class,'index']);
Route::get('/me',[AuthController::class,'me']);
Route::get('/logout',[AuthController::class,'logout']);
Route::post('/posttweet',[TweetController::class,'store']);
Route::delete('/deletetweet/{id}',[TweetController::class,'destroy']);
});
Route::get('/tweet',[TweetController::class,'index']);
Route::post('/login',[AuthController::class,'login']);

