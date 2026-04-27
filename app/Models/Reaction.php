<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use App\Policies\ReactionPolicy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('reactions')]
#[Fillable(['type','reviewer_id','post_id'])]
#[UsePolicy(ReactionPolicy::class)]
class Reaction extends Model
{
    use HasUuids, HasFactory;
    
    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'reviewer_id', 'id');
    }

    public function post():BelongsTo{
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
