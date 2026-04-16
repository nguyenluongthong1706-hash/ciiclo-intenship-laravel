<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $reactions = $this->reactions ?? collect();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],

            'author' => [
                'id' => $this->author?->id,
                'name' => $this->author?->name,
            ],

            'reaction_count' => [
                'like' => $reactions->where('type', 'like')->count(),
                'dislike' => $reactions->where('type', 'dislike')->count(),
                'love' => $reactions->where('type', 'love')->count(),
                'angry' => $reactions->where('type', 'angry')->count(),
            ],

            'my_reaction' => optional(
                $reactions->where('reviewer_id', $request->user()?->id)->first()
            )->type,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
