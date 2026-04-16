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

        if(!$reaction){
            return response()->json(['message'=>"Make reaction fail"],400);
        }

        return response()->json(['message'=>"Make reaction successfully"],200);
    }

    public function deleteReaction($post_id, Request $request){
        $reaction = $this->reactionService->deleteReaction($request->user()->id, $post_id);

        if(!$reaction){
            return response()->json(['message'=>"Delete reaction fail"],400);
        }

        return response()->json(['message'=>"Delete reaction successfully"],200);
    }
}
