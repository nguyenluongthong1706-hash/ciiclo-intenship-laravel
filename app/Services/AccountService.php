<?php
namespace App\Services;

use App\Repositories\AccountRepository;

class AccountService{
    public function __construct(private AccountRepository $accountRepository){}

    public function find($id){
        return $this->accountRepository->find($id);
    }

    public function updateProfile(array $data, $id){
        return $this->accountRepository->update($data, $id);
    }

    public function show($id){
        return $this->accountRepository->find($id);
    }
}
