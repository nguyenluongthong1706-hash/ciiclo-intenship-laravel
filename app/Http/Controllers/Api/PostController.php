<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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

        $posts = PostResource::collection($posts);
        return response()->json(['message'=>"Get post successfully", 'posts'=>$posts],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $post = $this->postService->store($request->validated(), $request->user()->id);

        if(!$post){
            return response()->json(['message'=>'Create post fail'], 400);
        }

        return response()->json(['message'=>"Create successfully"],200);
    }

    public function getByUser(Request $request)
    {
        $posts = $this->postService->getByUser($request->user()->id);

        if(!$posts){
            return response()->json(['message'=>"Post is not exists",'posts'=>null],400);
        }

        $posts = PostResource::collection($posts);
        return response()->json(['message'=>"Get post successfully", 'posts'=>$posts],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->show($id);

        if(!$post){
            return response()->json(['message'=>"Post is not exists", 'post'=>null],400);
        }

        return response()->json(['message'=>"Get post successfully", 'post'=>$post],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = $this->postService->update($request->validated(),$id);

        if(!$post){
            return response()->json(['message'=>"Update post fail"],400);
        }

        return response()->json(['message'=>"Update successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = $this->postService->destroy($id);

        if(!$post){
            return response()->json(['message'=>"Delete post fail"],400);
        }

        return response()->json(['message'=>"Delete post successfully"],200);
    }
}
