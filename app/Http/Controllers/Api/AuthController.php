<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService){}
    
    public function register(Request $request){
        $user = $this->authService->register($request->all());
        
        if(!$user){
            return response()->json(['message'=>'register fail'], 401);
        }

        return response()->json(['user'=>$user],200);
    }

    public function login(Request $request){
        $user = $this->authService->login($request->all());

        if(!$user){
            return response()->json(['message'=>'Invalid Credentials'], 401);
        }

        $user->tokens()->delete();

        // create token and get token by text for client
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['user'=>$user, 'token'=>$token],200);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message'=>"logged out successfully"],200);
    }

}
