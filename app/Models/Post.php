<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Table('posts')]
#[Fillable(['title', 'content', 'author_id','category_id'])]
class Post extends Model
{
    use HasFactory, HasUuids;
    
    public function category():BelongsTo{
        return    $this->belongsTo(Category::class, 'category_id','id');
    }

    public function author():BelongsTo{
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function reactions():HasMany{
        return $this->hasMany(Rating::class,'post_id','id');
    }
}
