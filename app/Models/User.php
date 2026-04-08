<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquence\Concerns\Uuids;
use Illuminate\Database\Eloquence\Relations\HasMany;

#[Table('users')]
#[Fillable(['name','email','password','role','avatar'])]
#[Hidden(['password','remember_token'])]
class User extends Model
{
    use Uuids;
    
    public function post():HasMany{
        return $this->hasMany(Post::class,'author_id','id');
    }

    public function rating():HasMany{
        return $this->hasMany(Rating::class,'reviewer_id','id');
    }
}
