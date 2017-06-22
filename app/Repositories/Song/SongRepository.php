<?php

namespace App\Repositories\Song;

use Auth;
use App\Models\Song;
use App\Repositories\BaseRepository;
use Exception;
use File;
use App\Helpers\SetFile;
use App\Models\Category;
use App\Models\Singer;
use App\Models\Rating;
use App\Models\Comment;
use DB;

class SongRepository extends BaseRepository implements SongRepositoryInterface
{
    protected $categoryModel;
    protected $singerModel;
    protected $ratingModel;
    protected $commentModel;

    public function __construct(Song $song, Category $category, Singer $singer, Rating $rating, Comment $comment)
    {
        $this->model = $song;
        $this->categoryModel = $category;
        $this->singerModel = $singer;
        $this->ratingModel = $rating;
        $this->commentgModel = $comment;
    }

    public function getListAudios()
    {
        $data = $this->model->where('type', config('settings.audio'));
        if (!$data) {
            throw new Exception(trans('song.find_error'));
        }

        return $data;
    }

    public function getListVideos()
    {
        $data = $this->model->where('type', config('settings.video'));
        if (!$data) {
            throw new Exception(trans('song.find_error'));
        }

        return $data;
    }

    public function createAudio($request)
    {
        $input = [
            'name' => $request['name'],
            'author' => $request['author'],
            'description' => $request['description'],
            'category_id' => ($request['category_id'] == 0) ? null : $request['category_id'],
            'singer_id' => ($request['singer_id'] == 0) ? null : $request['singer_id'],
            'type' => config('settings.audio'),
        ];
        $nameCoverImage = SetFile::uploadCoverAudio($request);
        $input['cover'] = isset($nameCoverImage) ? $nameCoverImage : config('settings.cover_default');
        $nameAudioFile = SetFile::uploadAudio($request);
        $input['link'] = $nameAudioFile;

        return $this->model->create($input);
    }

    public function updateAudio($input, $id)
    {
        $song = [
            'name' => $input['name'],
            'author' => $input['author'],
            'description' => $input['description'],
            'category_id' => ($input['category_id'] == 0) ? null : $input['category_id'],
            'singer_id' => ($input['singer_id'] == 0) ? null : $input['singer_id'],
        ];
        $nameCoverImage = SetFile::uploadCoverAudio($input);
        $song['cover'] = isset($nameCoverImage) ? $nameCoverImage : $input['current_img'];
        if ($input['current_img'] != config('settings.cover_default') && isset($nameCoverImage)) {
            file::delete(config('settings.audio_cover_src') . $input['current_img']);
        }
        $nameAudioFile = SetFile::uploadAudio($input);
        $song['link'] = isset($nameAudioFile) ? $nameAudioFile : $input['current_file'];
        if (isset($nameAudioFile)) {
            file::delete(config('settings.audio_src') . $input['current_file']);
        }

        return $this->model->find($id)->update($song);
    }

    public function deleteAudio($id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return false;
        }
        DB::beginTransaction();
        try {
            $this->ratingModel
                ->where('type', config('settings.rate.song'))
                ->where('target_id', $id)
                ->delete();
            $this->commentModel
                ->where('type', config('settings.comment.song'))
                ->where('target_id', $id)
                ->delete();
            if ($data['cover'] != config('settings.cover_default')) {
                file::delete(config('settings.audio_cover_src') . $data['cover']);
            }
            file::delete(config('settings.audio_src') . $data['link']);
            $data->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function createVideo($request)
    {
        $input = [
            'name' => $request['name'],
            'author' => $request['author'],
            'description' => $request['description'],
            'category_id' => ($request['category_id'] == 0) ? null : $request['category_id'],
            'singer_id' => ($request['singer_id'] == 0) ? null : $request['singer_id'],
            'type' => config('settings.video'),
        ];
        $nameCoverImage = SetFile::uploadCoverVideo($request);
        $input['cover'] = isset($nameCoverImage) ? $nameCoverImage : config('settings.cover_default');
        $nameVideoFile = SetFile::uploadVideo($request);
        $input['link'] = $nameVideoFile;

        return $this->model->create($input);
    }

    public function updateVideo($input, $id)
    {
        $song = [
            'name' => $input['name'],
            'author' => $input['author'],
            'description' => $input['description'],
            'category_id' => ($input['category_id'] == 0) ? null : $input['category_id'],
            'singer_id' => ($input['singer_id'] == 0) ? null : $input['singer_id'],
        ];
        $nameCoverImage = SetFile::uploadCoverVideo($input);
        $song['cover'] = isset($nameCoverImage) ? $nameCoverImage : $input['current_img'];
        if ($input['current_img'] != config('settings.cover_default') && isset($nameCoverImage)) {
            file::delete(config('settings.video_cover_src') . $input['current_img']);
        }
        $nameVideoFile = SetFile::uploadVideo($input);
        $song['link'] = isset($nameVideoFile) ? $nameVideoFile : $input['current_file'];
        if (isset($nameVideoFile)) {
            file::delete(config('settings.video_src') . $input['current_file']);
        }

        return $this->model->find($id)->update($song);
    }

    public function deleteVideo($id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return false;
        }
        DB::beginTransaction();
        try {
            $this->ratingModel
                ->where('type', config('settings.rate.song'))
                ->where('target_id', $id)
                ->delete();
            if ($data['cover'] != config('settings.cover_default')) {
                file::delete(config('settings.video_cover_src') . $data['cover']);
            }
            file::delete(config('settings.video_src') . $data['link']);
            $data->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function searchSong($keyword)
    {
        $categoryIds = $this->categoryModel->where('name', 'like', "%$keyword%")->pluck('id');
        $singerIds = $this->singerModel->where('name', 'like', "%$keyword%")->pluck('id');
        $songs = $this->model->where(function ($query) use ($keyword, $categoryIds, $singerIds) {
            $query->where('name', 'like', "%$keyword%")->orWhere('author', 'like', "%$keyword%");
            foreach ($categoryIds as $categoryId) {
                $query->orWhere('category_id', $categoryId);
            }
            foreach ($singerIds as $singerId) {
                $query->orWhere('singer_id', $singerId);
            }
        });

        return $songs;
    }

    public function searchAudio($keyword)
    {
        return $this->searchSong($keyword)->where('type', config('settings.audio'));
    }

    public function searchVideo($keyword)
    {
        return $this->searchSong($keyword)->where('type', config('settings.video'));
    }

    public function getAudioOfSinger($id)
    {
        return $this->model->where('singer_id', $id)->where('type', config('settings.audio'));
    }

    public function getVideoOfSinger($id)
    {
        return $this->model->where('singer_id', $id)->where('type', config('settings.video'));
    }

    public function getNewAudio()
    {
        return $this->model
            ->where('type', config('settings.audio'))
            ->orderBy('created_at')
            ->take(config('settings.new'))
            ->get();
    }

    public function getHotAudio()
    {
        return $this->model
            ->where('type', config('settings.audio'))
            ->where('is_hot', config('settings.hot'))
            ->orderBy('rate_point', 'desc');
    }

    public function getHotVideo()
    {
        return $this->model
            ->where('type', config('settings.video'))
            ->where('is_hot', config('settings.hot'))
            ->orderBy('rate_point', 'desc');
    }

    public function getListAudioOfAlbum($albumId)
    {
        return $this->model->whereIn('id', function ($query) use ($albumId) {
                $query->select('song_id')->from('album_details')->where('album_id', $albumId)->get();
        })->get();
    }

    public function getAudioOfTopic($categoryId)
    {
        return $this->model
            ->where('type', config('settings.audio'))
            ->where('category_id', $categoryId)
            ->orderBy('name')
            ->paginate(config('settings.list_item'));
    }

    public function getVideoOfTopic($categoryId)
    {
        return $this->model
            ->where('type', config('settings.video'))
            ->where('category_id', $categoryId)
            ->orderBy('name')
            ->paginate(config('settings.list_item'));
    }

    public function searchAudioHome($keyword)
    {
        return $this->model
            ->where('name', 'like', "%$keyword%")
            ->where('type', config('settings.audio'))
            ->orderBy('rate_point', 'desc');
    }

    public function searchVideoHome($keyword)
    {
        return $this->model
            ->where('name', 'like', "%$keyword%")
            ->where('type', config('settings.video'))
            ->orderBy('rate_point', 'desc');
    }

    public function getTopRateAudio()
    {
        return $this->model
            ->where('type', config('settings.audio'))
            ->orderBy('rate_point', 'desc')
            ->take(config('settings.top_count'));
    }

    public function getTopRateVideo()
    {
        return $this->model
            ->where('type', config('settings.video'))
            ->orderBy('rate_point', 'desc')
            ->take(config('settings.top_count'));
    }
}
