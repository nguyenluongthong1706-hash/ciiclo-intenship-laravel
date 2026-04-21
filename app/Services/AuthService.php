<?php
namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\BusinessException;

class AuthService  {
    public function __construct (private AuthRepository $authRepository){}

    // define the method for registration
    public function register(array $data){
        $user = $this->authRepository->findByEmail($data['email']);
        
        if($user){
            throw new \BusinessException("Email không tồn tại trong hệ thống",1000,);
        }

        $data['password'] = Hash::make($data['password']);
        return $this->authRepository->create($data);   
    }

    public function login(array $data){
        $user = $this->authRepository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new BusinessException("Email hay Password không chính xác");
        }

        return $user;
    }
}