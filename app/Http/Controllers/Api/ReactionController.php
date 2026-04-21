<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ReactionService;
use App\Http\Requests\MakeReactionRequest;

class ReactionController extends Controller
{
    public function __construct (private ReactionService $reactionService){}

    public function makeReaction ($post_id, MakeReactionRequest $request){
        $reaction = $this->reactionService->makeReaction($request->user()->id, $post_id, $request->validated());

        return response()->json(['message'=>"Thực hiện phản hồi thành công"],200);
    }

    public function deleteReaction($post_id, Request $request){
        $reaction = $this->reactionService->deleteReaction($request->user()->id, $post_id);

        return response()->json(['message'=>"Xóa phản hồi thành công"],200);
    }
}
