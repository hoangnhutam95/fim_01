<?php

namespace App\Repositories\Favorite;

use Auth;
use App\Models\Favorite;
use App\Models\FavoriteDetail;
use App\Repositories\BaseRepository;
use Exception;
use File;
use DB;
use App\Helpers\SetFile;

class FavoriteRepository extends BaseRepository implements FavoriteRepositoryInterface
{
    protected $favoriteDetailModel;

    public function __construct(Favorite $favorite, FavoriteDetail $favoriteDetail)
    {
        $this->model = $favorite;
        $this->favoriteDetailModel = $favoriteDetail;
    }

    public function createFavorite($request)
    {
        $input = [
            'name' => $request['name'],
            'user_id' => auth()->user()->id,
        ];
        $nameCoverImage = SetFile::uploadCoverFavorite($request);
        $input['cover'] = isset($nameCoverImage) ? $nameCoverImage : config('settings.cover_default');

        return $this->model->create($input);
    }

    public function createFavoriteDetail($favoriteId, $request)
    {
        $favoriteDeatil = $this
            ->favoriteDetailModel
            ->where('favorite_id', $favoriteId)
            ->where('song_id', $request['song_id'])->first();
        if ($favoriteDeatil) {
            return null;
        }
        $input = [
            'favorite_id' => $favoriteId,
            'song_id' => $request['song_id'],
        ];

        return $this->favoriteDetailModel->create($input);
    }

    public function getListFavorite()
    {
        return $this->model->where('user_id', auth()->user()->id)->orderBy('name');
    }

    public function removeSongFromPlaylist($id, $request)
    {
        return $this->favoriteDetailModel
            ->where('favorite_id', $id)
            ->where('song_id', $request['song_id'])
            ->first()
            ->delete();
    }
}
