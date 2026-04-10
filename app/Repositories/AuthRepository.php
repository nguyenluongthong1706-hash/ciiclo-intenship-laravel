<?php
namespace App\Repositories;

use App\Models\User;

class AuthRepository extends Repository{
    public function __construct (User $user){
        $this->model = $user;
    }

    public function findByEmail(string $email){
        return $this->model::where('email', $email)->first();
    }
}