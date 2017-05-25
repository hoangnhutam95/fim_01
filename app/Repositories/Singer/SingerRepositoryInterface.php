<?php
namespace App\Repositories\Singer;

interface SingerRepositoryInterface
{
    public function getListSingers();

    public function createSinger($request);

    public function updateSinger($input, $id);

    public function deleteSinger($id);
}
