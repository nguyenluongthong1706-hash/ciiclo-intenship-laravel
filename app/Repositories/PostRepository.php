<?php
namespace App\Repositories;

use App\Models\Post;

class PostRepository extends Repository{
    public function __construct(Post $post){
        $this->model = $post;
    }
    public function all (){
        return $this->model
        ->with(['category:id,name', 'author:id,name', 'reactions'])
        ->get();
    }
    public function getByUser($id){
        return $this->model->where('author_id',$id)->with(['category:id,name','author:id,name', 'reactions'])->get();
    }
}