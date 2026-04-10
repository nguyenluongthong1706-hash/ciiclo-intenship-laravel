<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(private PostService $postService){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->getAll();

        return response()->json(['posts'=>$posts],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $post = $this->postService->store($request->all());

        if(!$post){
            return response()->json(['message'=>'Create post fail'], 400);
        }

        return response()->json(['message'=>"Create successfully"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->show($id);

        if(!$post){
            return response()->json(['message'=>"Post is not exists"],400);
        }

        return response()->json(['post'=>$post],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = $this->postService->update($request->all(),$id);

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
