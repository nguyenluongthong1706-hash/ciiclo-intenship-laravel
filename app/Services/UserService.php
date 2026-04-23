<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService{
    public function __construct (private UserRepository $userRepository){}

    public function getAll(){
        return $this->userRepository->all();
    }

    public function show($id){
        return $this->userRepository->find($id);
    }

    public function store(array $data){
        return $this->userRepository->create($data);
    }

    public function update(array $data, $id){
        return $this->userRepository->update($data, $id);
    }

    public function destroy($id){
        return $this->userRepository->delete($id);
    }
}