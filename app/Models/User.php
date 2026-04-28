<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

#[Table('users')]
#[Fillable(['name','email','password','role','avatar','avatar_public_id', 'is_active'])]
#[Hidden(['password','remember_token'])]
#[UsePolicy(UserPolicy::class)]
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasUuids, HasApiTokens;
    
    public function posts():HasMany{
        return $this->hasMany(Post::class,'author_id','id');
    }

    public function reactions():HasMany{
        return $this->hasMany(Rating::class,'reviewer_id','id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
