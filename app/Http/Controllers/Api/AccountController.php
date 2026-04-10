<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function __construct (private AccountService $accountService){}

    public function getProfile (Request $request){
        $user = $this->accountService->getById($request->user()->id);
        if(!$user){
            return response()->json(['message'=>"User is not exists"],400);
        }
        return response()->json(['user'=>$user],200);
    }

    public function updateProfile (Request $request){
        $user = $this->accountService->updateProfile($request->all(), $request->user()->id);

        if(!$user){
            return response()->json(['message'=> "Update profile fail"],400);
        }

        return response()->json(['message'=>"Update post successfully"],200);
    }
}
