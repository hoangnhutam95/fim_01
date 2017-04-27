<?php
/**
* Base Repository
*/
namespace App\Repositories;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($limit)
    {
        return $this->model->paginate($limit);
    }

    public function create($input)
    {
        return $this->model->create($inputs);
    }

    public function update($input, $id)
    {
        return $this->model->find($id)->update($inputs);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
