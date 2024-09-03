<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Mail\UserFollowed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::middleware('api_localization')->group(function () {


    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/timeline', [TweetController::class, 'timeline']);
        Route::post('/tweets', [TweetController::class, 'store']);
        Route::post('/follow', [UserController::class, 'follow']);
    });

});


