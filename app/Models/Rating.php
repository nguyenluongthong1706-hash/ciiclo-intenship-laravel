<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['vote','reviewer_id','post_id'])]
class Rating extends Model
{
    use HasFactory, HasUuids;
    
    public function reviewer():BelongsTo{
        return $this->belongsTo(User::class,'reviewer_id','id');
    }

    public function post():BelongsTo{
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
