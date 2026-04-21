<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use PDOException;
use ParseError;
use Illuminate\Http\Request;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function(ModelNotFoundException $e, Request $request){
            return response()->json(['message' => 'Không thể tìm đối tượng'],404);
        });
        $exceptions->render(function(QueryException $e, Request $request){
            return response()->json(['message'=>'Lỗi DB'],500);
        });
        $exceptions->render(function(ValidationException $e, Request $request){
            return response()->json([
                'message'=>'Lỗi xác thực dữ liệu',
                'errors' => $e->errors()
            ],422);
        });
        $exceptions->render(function(AuthenticationException $e, Request $request){
            return response()->json(['message'=>'Lỗi xác thực người dùng'],401);
        });
        $exceptions->render(function(AuthorizationException $e, Request $request){
            return response()->json(['message'=>'Lỗi Phân quyền'],403);
        });
    })->create();
