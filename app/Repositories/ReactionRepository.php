<?php
namespace App\Repositories;

use App\Models\Reaction;

class ReactionRepository extends Repository{
    public function __construct (Reaction $reaction){
        $this->model = $reaction;
    }

    public function makeReaction($reviewer_id, $post_id, array $data){
        return $this->model->updateOrCreate(
            ['reviewer_id'=>$reviewer_id, 'post_id'=>$post_id],
            $data
        );
    }

    public function deleteReaction($reviewer_id,$post_id){
        return $this->model->where([
            'reviewer_id'=>$reviewer_id,
            'post_id'=>$post_id
        ])->delete();
    }
}