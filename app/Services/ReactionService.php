<?php
namespace App\Services;

use App\Repositories\ReactionRepository;

class ReactionService{
    public function __construct(private ReactionRepository $reactionRepository){}

    public function makeReaction($reviewer_id,$post_id,array $data){
        return $this->reactionRepository->makeReaction($reviewer_id,$post_id,$data);
    }

    public function deleteReaction($reviewer_id,$post_id){
        return $this->reactionRepository->deleteReaction($reviewer_id,$post_id);
    }
}