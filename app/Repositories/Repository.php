<?php
namespace App\Repositories;

abstract class Repository {
    protected $model;

    public function all(){
        return $this->model->all();
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function update(array $data, $id){
        $curentModel = $this->model->findOrFail($id);

        $curentModel->update($data);   
        
        return $curentModel;
    }

    public function create(array $data){
        return $this->model->create($data);
    }

    public function delete($id){
        return $this->model->destroy($id);
    }
}