<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UploadAvatarRequest;
use App\Services\UploadImageService;

class AccountController extends Controller
{
    public function __construct (private AccountService $accountService){}

    public function getProfile()
    {
        return response()->json(['message'=>"Lấy thông tin tài khoản thành công", 'data'=>auth('api')->user()],200);
    }

    // public function getProfile (Request $request){
    //     $user = $this->accountService->show($request->user()->id);
    //     $this->authorize('view', $user);

    //     $user = $this->accountService->find($request->user()->id);

    //     return response()->json(['message'=>"Lấy thông tin tài khoản thành công", 'data'=>$user],200);
    // }

    public function updateProfile (UpdateProfileRequest $request){
        $user = $this->accountService->show($request->user()->id);
        $this->authorize('update', $user);

        $user = $this->accountService->updateProfile($request->validated(), $request->user()->id);

        return response()->json(['message'=>"Cập nhật tài khoản thành công"],200);
    }

    public function uploadAvatar(UploadAvatarRequest $request, UploadImageService $uploadAvatarService){
        $user = $this->accountService->show($request->user()->id);
        $this->authorize('update', $user);

        $result = $uploadAvatarService->updateImage($user->avatar_public_id, $request->file('avatar'));

        $user = $this->accountService->updateProfile(
            [ 
                'avatar' => $result['url'],
                'avatar_public_id' => $result['public_id']
            ], 
            $request->user()->id
        );

        return response()->json(['message'=>"Cập nhật tài khoản thành công",'data'=>['url'=>$result['url']]],200);
    }
}
