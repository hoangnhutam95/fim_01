<?php
namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function getAll();

    public function create($request);

    public function delete($id);

    public function update($request, $id);

    public function getListSongCategories();

    public function getListAlbumCategories();

    public function getSongCategories();

    public function getAlbumCategories();
}
