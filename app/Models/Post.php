<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquence\Concerns\Uuids;
use Illuminate\Database\Eloquence\Relations\BelongsTo;
use Illuminate\Database\Eloquence\Relations\HasMany;

#[Table('posts')]
#[Fillable(['title', 'content', 'author_id','category_id'])]
class Post extends Model
{
    use HasUuids;
    
    public function category():BelongsTo{
        return    $this->belongsTo(Category::class, 'category_id','id');
    }

    public function author():BelongsTo{
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function rating():HasMany{
        return $this->hasMany(Rating::class,'post_id','id');
    }
}
