<?php
namespace App\Repositories;

use App\Exceptions\SystemException;

abstract class Repository {
    protected $model;

    public function all(){
        return $this->model->all();
    }

    public function find($id){
        return $this->model->findOrFail($id);
    }

    public function update(array $data, $id){
        $currentModel = $this->model->findOrFail($id);

        $currentModel->update($data);   
        
        return $currentModel;
    }

    public function create(array $data){
        return $this->model->create($data);
    }

    public function delete($id){
        $model = $this->model->findOrFail($id);
        $model->delete();

        return true;
    }
}