<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ReactionController;

Route::get('/', function(){
    return "Well come our app";
});

Route::controller(AuthController::class)->middleware('throttle:auth')->group(function(){
    Route::prefix('auth')->group(function(){
        Route::post('/register', 'register');
        Route::post('/login','login');
    });
});

Route::get('posts',[PostController::class, 'index']);
Route::get('posts/{post_id}',[PostController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function(){
    // define logout route
    Route::post('auth/logout',[AuthController::class, 'logout']);

    // group account controller
    Route::controller(AccountController::class)->group(function(){
        Route::prefix('users')->group(function(){
            Route::get('/me', 'getProfile');
            Route::put('/me', 'updateProfile');
            Route::put('/avatar','uploadAvatar');
            Route::get('/posts',[PostController::class, 'getByUser']);
        });
    });
    Route::apiResource('users', UserController::class);

    Route::put('users/{user_id}/status',[UserController::class, 'updateStatus']);

    Route::prefix('posts')->group(function(){
        Route::post('/{post_id}/reactions',[ReactionController::class, 'makeReaction'])->middleware('throttle:reaction');
        Route::put('/{post_id}/reactions',[ReactionController::class,'makeReaction'])->middleware('throttle:reaction');
        Route::delete('/{post_id}/reactions',[ReactionController::class,'deleteReaction']);
    });
    
    Route::apiResource('posts', PostController::class)->only(['store','update','destroy']);

    Route::put('posts/{post_id}/status',[PostController::class, 'updateStatus']);

    Route::apiResource('categories', CategoryController::class);

    Route::put('categories/{category_id}/status',[CategoryController::class, 'updateStatus']);
});
