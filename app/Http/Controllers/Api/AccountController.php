<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Http\Requests\UpdateProfileRequest;

class AccountController extends Controller
{
    public function __construct (private AccountService $accountService){}

    public function getProfile (Request $request){
        $user = $this->accountService->getById($request->user()->id);
        if(!$user){
            return response()->json(['message'=>"User is not exists", 'user'=>null],400);
        }
        return response()->json(['message'=>"Get account successfuly", 'user'=>$user],200);
    }

    public function updateProfile (UpdateProfileRequest $request){
        $user = $this->accountService->updateProfile($request->validated(), $request->user()->id);

        if(!$user){
            return response()->json(['message'=> "Update profile fail"],400);
        }

        return response()->json(['message'=>"Update post successfully"],200);
    }
}
