<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

#[Table('users')]
#[Fillable(['name','email','password','role','avatar','is_active'])]
#[Hidden(['password','remember_token'])]
class User extends Model
{
    use HasFactory, HasUuids, HasApiTokens;
    
    public function posts():HasMany{
        return $this->hasMany(Post::class,'author_id','id');
    }

    public function reactions():HasMany{
        return $this->hasMany(Rating::class,'reviewer_id','id');
    }
}
