<?php
namespace App\Repositories\Favorite;

interface FavoriteRepositoryInterface
{
    public function createFavorite($request);

    public function createFavoriteDetail($favoriteId, $songid);

    public function getListFavorite();
}
