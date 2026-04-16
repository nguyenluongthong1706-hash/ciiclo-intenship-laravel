<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService){}
    
    public function register(RegisterRequest $request){

        $user = $this->authService->register($request->validated());
        
        if(!$user){
            return response()->json([
                'message'=>'register fail',
            ], 400);
        }

        return response()->json([
            'message'=>'register successfully',
        ],200);
    }

    public function login(LoginRequest $request){
        $user = $this->authService->login($request->validated());

        if(!$user){
            return response()->json([
                'message'=>'Invalid Credentials',
                'user'=>null,
                'token'=>null,
                ], 401);
        }

        $user->tokens()->delete();

        // create token and get token by text for client
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message'=>'Login successfully',
            'user'=>$user,
            'token'=>$token,
        ],200);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message'=>"logged out successfully"],200);
    }

}
