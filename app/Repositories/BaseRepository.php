<?php
/**
* Base Repository
*/
namespace App\Repositories;

use Exception;

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

    public function find($id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            throw new Exception(trans('user.find_error'));
        }

        return $data;
    }

    public function create($input)
    {
        return $this->model->create($input);
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
