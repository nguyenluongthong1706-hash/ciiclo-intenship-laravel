<?php
namespace App\Repositories;

use App\Models\User;

class AccountRepository extends Repository{

    public function __construct(User $user){
        $this->model = $user;
    }
}