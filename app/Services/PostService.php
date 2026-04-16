<?php
namespace App\Services;

use App\Repositories\PostRepository;

class PostService{
    public function __construct(private PostRepository $postRepository){}

    public function getAll (){
        return $this->postRepository->all();
    }

    public function getByUser ($id){
        return $this->postRepository->getByUser($id);
    }

    public function show ($id){
        return $this->postRepository->find($id);
    }
    
    public function store(array $data, $id){
        $data['author_id'] = $id;
        return $this->postRepository->create($data);
    }

    public function update (array $data, $id){
        return $this->postRepository->update($data, $id);
    }

    public function destroy ($id){
        return $this->postRepository->delete($id);
    }
}