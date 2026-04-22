<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ReactionController;

Route::get('/', function(){
    return "Well come our app";
});

Route::controller(AuthController::class)->group(function(){
    Route::prefix('auth')->group(function(){
        Route::post('/register', 'register')->middleware('throttle:3,1');
        Route::post('/login','login')->middleware('throttle:login');
    });
});

Route::middleware(['auth:sanctum'])->group(function(){
    // define logout route
    Route::post('auth/logout',[AuthController::class, 'logout']);

    // group account controller
    Route::controller(AccountController::class)->group(function(){
        Route::prefix('users')->group(function(){
            Route::get('/me', 'getProfile');
            Route::put('/me', 'updateProfile');
            Route::get('/posts',[PostController::class, 'getByUser']);
        });
    });

    Route::prefix('posts')->group(function(){
        Route::post('/{post_id}/reactions',[ReactionController::class, 'makeReaction'])->middleware('throttle:10,1');
        Route::put('/{post_id}/reactions',[ReactionController::class,'makeReaction'])->middleware('throttle:10,1');
        Route::delete('/{post_id}/reactions',[ReactionController::class,'deleteReaction']);
    });

    Route::apiResource('posts', PostController::class);

    Route::apiResource('categories', CategoryController::class);
});
