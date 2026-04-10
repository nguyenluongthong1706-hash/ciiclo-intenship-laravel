<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Table('categories')]
#[Fillable(['name'])]
class Category extends Model
{
    use HasFactory, HasUuids;
    
    public function posts():HasMany{
        return $this->belongsTo(Post::class, 'category_id', 'id');
    }
}
