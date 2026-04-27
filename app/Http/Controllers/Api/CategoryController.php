<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\UpdateObjectStatus;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', \App\Models\Category::class);

        $categories = $this->categoryService->getAll();

        return response()->json(['message'=>"Lấy danh sách category thành công", 'data'=>$categories],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->authorize('create', \App\Models\Category::class);

        $category = $this->categoryService->store($request->validated());

        return response()->json(['message'=>"Tạo category thành công"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryService->show($id);
        $this->authorize('view', $category);

        $category = $this->categoryService->show($id);

        return response()->json(['message'=>"Lấy category thành công", 'data'=>$category],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = $this->categoryService->show($id);
        $this->authorize('update', $category);

        $category = $this->categoryService->update($request->validated(), $id);


        return response()->json(['message'=>"Cập nhật category thành công"],200);
    }

    public function updateStatus(UpdateObjectStatus $request, string $id)
    {
        $category = $this->categoryService->show($id);
        $this->authorize('update', $category);

        $category = $this->categoryService->update($request->all(), $id);


        return response()->json(['message'=>"Cập nhật trạng thái thành công"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryService->show($id);
        $this->authorize('delete', $category);

        $category = $this->categoryService->destroy($id);

        return response()->json(['message'=>"Xóa category thành công"],200);
    }
}
