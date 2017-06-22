<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Singer\SingerRepositoryInterface;
use App\Repositories\Song\SongRepositoryInterface;

class SingerController extends Controller
{
    protected $singerRepository;
    protected $songRepository;

    public function __construct(
        SingerRepositoryInterface $singerRepository,
        SongRepositoryInterface $songRepository
    ) {
        $this->singerRepository = $singerRepository;
        $this->songRepository = $songRepository;
    }

    public function index()
    {
        $singers = $this->singerRepository->getSinger()->paginate(config('settings.list_item'));

        return view('user.category_detail.singer', compact('singers'));
    }

    public function show($id)
    {
        $singer = $this->singerRepository->find($id);
        $videosOfSinger = $this->songRepository
            ->getVideoOfSinger($id)
            ->paginate(config('settings.list_per_page'));
        $audiosOfSinger = $this->songRepository
            ->getAudioOfSinger($id)
            ->paginate(config('settings.list_per_page'));

        return view('user.singer.singer_suggest', compact('singer', 'videosOfSinger', 'audiosOfSinger'));
    }

    public function showAudio($id)
    {
        $singer = $this->singerRepository->find($id);
        $audios = $this->songRepository
            ->getAudioOfSinger($id)
            ->paginate(config('settings.list_item'));

        return view('user.singer.singer_audio', compact('singer', 'audios'));
    }

    public function showVideo($id)
    {
        $singer = $this->singerRepository->find($id);
        $videos = $this->songRepository
            ->getVideoOfSinger($id)
            ->paginate(config('settings.list_item'));

        return view('user.singer.singer_video', compact('singer', 'videos'));
    }
}
