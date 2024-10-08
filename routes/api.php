<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/timeline', [TweetController::class, 'timeline']);
    Route::post('/tweets', [TweetController::class, 'store']);
    Route::post('/follow', [UserController::class, 'follow']);
});




