<?php
namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService{
    public function __construct (private CategoryRepository $categoryRepository){}

    public function getAll(){
        return $this->categoryRepository->all();
    }

    public function show($id){
        return $this->categoryRepository->find($id);
    }

    public function store(array $data){
        return $this->categoryRepository->create($data);
    }

    public function update(array $data, $id){
        return $this->categoryRepository->update($data, $id);
    }

    public function destroy($id){
        return $this->categoryRepository->delete($id);
    }
}