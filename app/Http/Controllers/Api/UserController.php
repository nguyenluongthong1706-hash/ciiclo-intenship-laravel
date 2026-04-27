<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateObjectStatus;

class UserController extends Controller
{
    public function __construct (private UserService $userService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = $this->userService->getAll();

        return response()->json(['message'=>"Lấy danh sách người dùng thành công!", 'data'=>$user],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', \App\Models\Post::class);

        $user = $this->userService->store($request->validated(), $request->user()->id);

        return response()->json(['message'=>"Tạo tài khoản thành công!"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->show($id);
        $this->authorize('view', $user);

        $user = $this->userService->show($id);

        return response()->json(['message'=>"Lấy thông tin tài khoản thành công!", 'data'=>$user],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, string $id)
    {
        $user = $this->userService->show($id);
        $this->authorize('update', $user);

        $user = $this->userService->update($request->validated(),$id);

        return response()->json(['message'=>"Cập nhật tài khoản thành công!"], 200);
    }

    public function updateStatus(UpdateObjectStatus $request, string $id){
        $user = $this->userService->show($id);
        $this->authorize('update', $user);

        $user = $this->userService->update($request->validated(),$id);

        return response()->json(['message'=>"Cập nhật trạng thái thành công!"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->show($id);
        $this->authorize('delete', $user);

        $user = $this->userService->destroy($id);

        return response()->json(['message'=>"Xóa tài khoản thành công!"],200);
    }
}
