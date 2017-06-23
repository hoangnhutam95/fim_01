<?php
namespace App\Repositories\Album;

interface AlbumRepositoryInterface
{
    public function searchAlbum($keyword);

    public function createAlbum($request);

    public function updateAlbum($input, $id);

    public function deleteAlbum($id);

    public function removeSongFromAlbum($albumDetailId);

    public function searchAudioImportToAlbum($keyword, $id);

    public function getHotAlbum();

    public function getCategoryOfAlbum($categoryId);

    public function getListAlbumOfCategory($categoryId);

    public function searchAlbumHome($keyword);

    public function getTopRateAlbum();

    public function setNotHotAlbum($id);

    public function setHotAlbum($id);
}
