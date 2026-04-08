<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquence\Concerns\Uuids;
use Illuminate\Database\Eloquence\Relations\HasMany;

#[Table('categories')]
#[Fillable(['name'])]
class Category extends Model
{
    use HasUuids;
    
    public function post():HasMany{
        return $this->belongsTo(Post::class, 'category_id', 'id');
    }
}
