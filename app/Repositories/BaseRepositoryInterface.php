<?php
namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function all();

    public function create($input);

    public function find($id);

    public function paginate($limit);

    public function update($id, $input);

    public function delete($id);
}
