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

        return response()->json(['message'=>"Lấy danh sách category thành công", 'data'=>$categories],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $this->categoryService->store($request->all());

        return response()->json(['message'=>"Tạo category thành công"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryService->show($id);

        return response()->json(['message'=>"Lấy category thành công", 'data'=>$category],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = $this->categoryService->update($request->all(), $id);


        return response()->json(['message'=>"Cập nhật category thành công"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryService->destroy($id);

        return response()->json(['message'=>"Xóa category thành công"],200);
    }
}
