<?php
namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function create($request);

    public function update($request, $id);

    public function delete($id);

    public function getUser();
}
