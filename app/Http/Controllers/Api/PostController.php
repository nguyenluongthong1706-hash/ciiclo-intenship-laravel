<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdateObjectStatus;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function __construct(private PostService $postService){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->getAll();

        return response()->json(['message'=>"Lấy danh sách bài đăng thành công!", 'data'=>PostResource::collection($posts)],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $this->authorize('create', \App\Models\Post::class);

        $post = $this->postService->store($request->validated(), $request->user()->id);

        return response()->json(['message'=>"Tạo bài đăng thành công!"],201);
    }

    public function getByUser(Request $request)
    {
        $this->authorize('viewAny', \App\Models\Post::class);

        $posts = $this->postService->getByUser($request->user()->id);

        return response()->json(['message'=>"Lấy thông tin danh sách bài đăng của tài khoản thành công!", 'data'=>PostResource::collection($posts)],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->show($id);
        $this->authorize('view', $post);

        $post = $this->postService->show($id);

        return response()->json(['message'=>"Lấy thông tin bài đăng thành công!", 'data'=>$post],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = $this->postService->show($id);
        $this->authorize('update', $post);

        $post = $this->postService->update($request->validated(),$id);

        return response()->json(['message'=>"Cập nhật bài đăng thành công!"], 200);
    }

    public function updateStatus(UpdateObjectStatus $request, string $id){
        $post = $this->postService->show($id);
        $this->authorize('update', $post);

        $user = $this->postService->update($request->validated(),$id);

        return response()->json(['message'=>"Cập nhật trạng thái thành công!"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = $this->postService->show($id);
        $this->authorize('delete', $post);

        $post = $this->postService->destroy($id);

        return response()->json(['message'=>"Xóa bài đăng thành công!"],200);
    }
}
