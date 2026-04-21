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
        $user = $this->accountService->find($request->user()->id);

        return response()->json(['message'=>"Lấy thông tin tài khoản thành công", 'data'=>$user],200);
    }

    public function updateProfile (UpdateProfileRequest $request){
        $user = $this->accountService->updateProfile($request->validated(), $request->user()->id);

        return response()->json(['message'=>"Cập nhật tài khoản thành công"],200);
    }
}
