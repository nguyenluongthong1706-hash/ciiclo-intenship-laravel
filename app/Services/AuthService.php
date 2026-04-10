<?php
namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthService  {
    public function __construct (private AuthRepository $authRepository){}

    // define the method for registration
    public function register(array $data){
        
        $data['password'] = Hash::make($data['password']);

        return $this->authRepository->create($data);
    }

    public function login(array $data){
        $user = $this->authRepository->findByEmail($data['email']);
        
        if(!$user || !Hash::check($data['password'], $user->password)){
            return null;
        }

        return $user;
    }
}