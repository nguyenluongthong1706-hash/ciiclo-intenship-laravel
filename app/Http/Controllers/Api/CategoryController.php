<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getAll();

        return response()->json(['message'=>"Get Category successfully", 'categories'=>$categories],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $this->categoryService->store($request->all());

        if(!$category){
            return response()->json(['message'=>"Create Category fail",  'category'=>null],400);
        }

        return response()->json(['message'=>"Create Category successfully"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryService->show($id);

        if(!$category){
            return response()->json(['message'=>"Category is not exists", 'category'=>null],400);
        }

        return response()->json(['message'=>"Get Category successfully", 'category'=>$category],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = $this->categoryService->update($request->all(), $id);

        if(!$category){
            return response()->json(['message'=>"Update Category fail"],400);
        }

        return response()->json(['message'=>"Update Category successfully"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryService->destroy($id);

        if(!$category){
            return response()->json(['message'=>"Delete Category fail"],400);
        }

        return response()->json(['message'=>"Delete Category successfully"],200);
    }
}
