<?php
namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function getAll();

    public function create($request);

    public function delete($id);

    public function update($request, $id);
}
