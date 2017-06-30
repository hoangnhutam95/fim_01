<?php

namespace App\Repositories\View;

use Auth;
use App\Models\View;
use App\Models\Song;
use App\Repositories\BaseRepository;
use Exception;
use File;
use DB;

class ViewRepository extends BaseRepository implements ViewRepositoryInterface
{
    protected $songModel;

    public function __construct(View $view, Song $song)
    {
        $this->model = $view;
        $this->songModel = $song;
    }

    public function updateViewCount($songId)
    {
        $view = $this->model->where('song_id', $songId)->first();
        if (!$view) {
            $newView = [
                'song_id' => $songId,
            ];
            $new = $this->model->create($newView);
        }
        $view = $this->model->where('song_id', $songId)->first();
        $viewCountAll = $view['view_count_all'];
        $viewCountWeek = $view['view_count_week'];
        $viewCountMonth = $view['view_count_month'];
        $viewCountAll = $viewCountAll + 1;
        $viewCountWeek = $viewCountWeek + 1;
        $viewCountMonth = $viewCountMonth + 1;

        return $view->update([
            'view_count_all' => $viewCountAll,
            'view_count_week' => $viewCountWeek,
            'view_count_month' => $viewCountMonth,
        ]);
    }

    public function getTopViewAllAudio()
    {
        return $this->model->whereIn('song_id', function ($query) {
                $query->select('id')->from('songs')->where('type', config('settings.audio'))->get();
        })->orderBy('view_count_all', 'desc')->take(config('settings.top_count'));
    }

    public function getTopViewWeekAudio()
    {
        return $this->model->whereIn('song_id', function ($query) {
                $query->select('id')
                    ->from('songs')->where('type', config('settings.audio'))->get();
        })->orderBy('view_count_week', 'desc')->take(config('settings.top_count'));
    }

    public function getTopViewMonthAudio()
    {
        return $this->model->whereIn('song_id', function ($query) {
                $query->select('id')
                    ->from('songs')->where('type', config('settings.audio'))->get();
        })->orderBy('view_count_month', 'desc')->take(config('settings.top_count'));
    }

    public function getTopViewAllVideo()
    {
        return $this->model->whereIn('song_id', function ($query) {
                $query->select('id')
                    ->from('songs')->where('type', config('settings.video'))->get();
        })->orderBy('view_count_all', 'desc')->take(config('settings.top_count'));
    }

    public function getTopViewWeekVideo()
    {
        return $this->model->whereIn('song_id', function ($query) {
                $query->select('id')
                    ->from('songs')->where('type', config('settings.video'))->get();
        })->orderBy('view_count_week', 'desc')->take(config('settings.top_count'));
    }

    public function getTopViewMonthVideo()
    {
        return $this->model->whereIn('song_id', function ($query) {
                $query->select('id')
                    ->from('songs')->where('type', config('settings.video'))->get();
        })->orderBy('view_count_month', 'desc')->take(config('settings.top_count'));
    }

    public function getViewOfSong($songId)
    {
        return $this->model->where('song_id', $songId)->first();
    }
}
