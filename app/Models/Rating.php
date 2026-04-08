<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquence\Concerns\Uuids;
#[Fillable(['point','reviewer_id','post_id'])]
class Rating extends Model
{
    use HasUuids;
    
    public function reviewer():BelongsTo{
        return $this->belongsTo(User::class,'reviewer_id','id');
    }

    public function post():BelongsTo{
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
