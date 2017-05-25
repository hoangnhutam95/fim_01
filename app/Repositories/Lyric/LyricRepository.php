<?php

namespace App\Repositories\Lyric;

use Auth;
use App\Models\Lyric;
use App\Models\Song;
use App\Repositories\BaseRepository;
use Exception;
use File;
use App\Helpers\SetFile;
use DB;

class LyricRepository extends BaseRepository implements LyricRepositoryInterface
{
    protected $songModel;

    public function __construct(Lyric $lyric, Song $song)
    {
        $this->model = $lyric;
        $this->songModel = $song;
    }

    public function getWattingLyric()
    {
        return $this->model
            ->where('status', config('settings.not-accept-lyric'))
            ->orderBy('created_at', 'desc')
            ->paginate(config('settings.lyric_per_page'));
    }

    public function getCurrentLyric($id)
    {
        $lyric = $this->model->find($id);

        return $this->model
            ->where('song_id', $lyric['song_id'])
            ->where('status', config('settings.current-lyric'))
            ->first();
    }

    public function acceptLyric($id)
    {
        DB::beginTransaction();
        try {
            $lyric = $this->model->find($id);
            $this->model
                ->where('song_id', $lyric['song_id'])
                ->where('status', config('settings.current-lyric'))
                ->update(['status' => config('settings.not-accept-lyric')]);
            $lyric->update(['status' => config('settings.current-lyric')]);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getSongLyric($songId)
    {
        return $this->model
            ->where('song_id', $songId)
            ->where('status', config('settings.current-lyric'))
            ->first();
    }

    public function searchSugestLyric($keyword)
    {
        $songIds = $this->songModel->where('name', 'like', "%$keyword%")->pluck('id');

        return $this->model->whereIn('song_id', $songIds)->paginate(config('settings.search_lyric_per_page'));
    }

    public function getListLyricOfSong($songId)
    {
        return $this->model
            ->where('song_id', $songId)
            ->where('status', config('settings.not-accept-lyric'))
            ->paginate(config('settings.lyric_per_page'));
    }

    public function createLyric($request)
    {
        $input = [
            'content' => $request['content'],
            'song_id' => $request['song_id'],
            'status' => config('settings.current-lyric'),
        ];
        DB::beginTransaction();
        try {
            $this->model
                ->where('song_id', $request['song_id'])
                ->where('status', config('settings.current-lyric'))
                ->update(['status' => config('settings.not-accept-lyric')]);
            $this->model->create($input);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
