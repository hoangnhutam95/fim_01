<?php

namespace App\Repositories\Album;

use Auth;
use App\Models\Album;
use App\Models\Rating;
use App\Models\AlbumDetail;
use App\Models\Song;
use App\Repositories\BaseRepository;
use Exception;
use File;
use App\Helpers\SetFile;
use DB;

class AlbumRepository extends BaseRepository implements AlbumRepositoryInterface
{
    protected $songModel;
    protected $ratingModel;
    protected $albumDetailModel;

    public function __construct(Album $album, Rating $rating, AlbumDetail $albumDetail, Song $song)
    {
        $this->model = $album;
        $this->ratingModel = $rating;
        $this->albumDetailModel = $albumDetail;
        $this->songModel = $song;
    }

    public function searchAlbum($keyword)
    {
        return $this->model->where('name', 'like', "%$keyword%");
    }

    public function createAlbum($request)
    {
        $input = [
            'name' => $request['name'],
            'category_id' => ($request['category_id'] == 0) ? null : $request['category_id'],
        ];
        $nameCoverImage = SetFile::uploadCoverAlbum($request);
        $input['cover'] = isset($nameCoverImage) ? $nameCoverImage : config('settings.cover_default');
        $nameAlbumFile = SetFile::uploadAudio($request);

        return $this->model->create($input);
    }

    public function updateAlbum($input, $id)
    {
        $album = [
            'name' => $input['name'],
            'category_id' => ($input['category_id'] == 0) ? null : $input['category_id'],
        ];
        $nameCoverImage = SetFile::uploadCoverAlbum($input);
        $song['cover'] = isset($nameCoverImage) ? $nameCoverImage : $input['current_img'];
        if ($input['current_img'] != config('settings.cover_default') && isset($nameCoverImage)) {
            file::delete(config('settings.album_cover_src') . $input['current_img']);
        }

        return $this->model->find($id)->update($album);
    }

    public function deleteAlbum($id)
    {
        $album = $this->model->find($id);
        DB::beginTransaction();
        try {
            $this->ratingModel
                ->where('type', config('settings.rate.album'))
                ->where('target_id', $id)
                ->delete();
            if ($album['cover'] != config('settings.cover_default')) {
                file::delete(config('settings.album_cover_src') . $album['cover']);
            }
            $this->model->destroy($id);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function removeSongFromAlbum($albumDetailId)
    {
        return $this->albumDetailModel->destroy($albumDetailId);
    }

    public function searchAudioImportToAlbum($keyword, $id)
    {
        $songIds = $this->albumDetailModel->select('song_id')->where('album_id', $id)->get();

        return $this->songModel
            ->where('type', config('settings.audio'))
            ->where('name', 'like', "%$keyword%")
            ->whereNotIn('id', function ($query) use ($id) {
                $query->select('song_id')->from('album_details')->where('album_id', $id)->get();
            })->paginate(config('settings.search_per_page'));
    }

    public function createAlbumDetail($songId, $id)
    {
        $input = [
            'song_id' => $songId,
            'album_id' => $id,
        ];

        return $this->albumDetailModel->create($input);
    }

    public function getHotAlbum()
    {
        return $this->model
            ->where('is_hot', config('settings.hot'))
            ->orderBy('rate_point')
            ->paginate(config('settings.list_per_page'));
    }

    public function getCategoryOfAlbum($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->orderBy('rate_point');
    }
}
