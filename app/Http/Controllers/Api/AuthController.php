<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService){}
    
    public function register(RegisterRequest $request){
        $this->authorize('create', \App\Models\User::class);

        $user = $this->authService->register($request->validated());

        return response()->json([
            'message'=>'Đăng ký thành công',
        ],200);
    }

    public function login(LoginRequest $request){
        $token = $this->authService->login($request->validated());

        $user = JWTAuth::setToken($token)->toUser();

        return response()->json([
            'message'=>'Đăng nhập thành công',
            'data'=>$user,
            'token' => $token
        ],200);
    }

    // public function login(LoginRequest $request){
    //     $user = $this->authService->login($request->validated());

    //     $user->tokens()->delete();

    //     // create token and get token by text for client
    //     $token = $user->createToken('api-token')->plainTextToken;

    //     return response()->json([
    //         'message'=>'Đăng nhập thành công',
    //         'data'=>$user,
    //         'token'=>$token,
    //     ],200);
    // }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message'=>"Đăng xuất thành công"],200);
    }

    // public function logout(Request $request){
    //     $request->user()->currentAccessToken()->delete();

    //     return response()->json(['message'=>"Đăng xuất thành công"],200);
    // }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }
}
