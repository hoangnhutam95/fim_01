<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Album\AlbumRepositoryInterface;
use App\Repositories\Singer\SingerRepositoryInterface;

class HomeController extends Controller
{

    protected $songRepository;
    protected $albumRepository;
    protected $singerRepository;

    public function __construct(
        SongRepositoryInterface $songRepository,
        AlbumRepositoryInterface $albumRepository,
        SingerRepositoryInterface $singerRepository
    ) {
        $this->songRepository = $songRepository;
        $this->albumRepository = $albumRepository;
        $this->singerRepository = $singerRepository;
    }

    public function index()
    {
        $newAudios = $this->songRepository->getNewAudio();
        $hotAudios = $this->songRepository->getHotAudio()->paginate(config('settings.list_per_page'));
        $hotVideos = $this->songRepository->getHotVideo()->paginate(config('settings.list_per_page'));
        $hotAlbums = $this->albumRepository->getHotAlbum()->paginate(config('settings.list_per_page'));

        return view('user.home', compact('newAudios', 'hotAudios', 'hotVideos', 'hotAlbums'));
    }

    public function showSongOfTopic($categoryId)
    {
        $audios = $this->songRepository->getAudioOfTopic($categoryId);

        return view('user.category_detail.audio', compact('audios'));
    }

    public function showVideoOfTopic($categoryId)
    {
        $videos = $this->songRepository->getVideoOfTopic($categoryId);

        return view('user.category_detail.video', compact('videos'));
    }
    public function showAlbumOfTopic($categoryId)
    {
        $albums = $this->albumRepository->getListAlbumOfCategory($categoryId);

        return view('user.category_detail.album', compact('albums'));
    }

    public function showHotAudio()
    {
        $audios = $this->songRepository->getHotAudio()->paginate(config('settings.list_item'));

        return view('user.category_detail.hot_audio', compact('audios'));
    }

    public function showHotVideo()
    {
        $videos = $this->songRepository->getHotVideo()->paginate(config('settings.list_item'));

        return view('user.category_detail.hot_video', compact('videos'));
    }

    public function showHotAlbum()
    {
        $albums = $this->albumRepository->getHotAlbum()->paginate(config('settings.list_item'));

        return view('user.category_detail.hot_album', compact('albums'));
    }

    public function search(Request $request)
    {
        $input = $request['search'];
        $audios = $this->songRepository->searchAudioHome($input)->paginate(config('settings.search-view'));
        $videos = $this->songRepository->searchVideoHome($input)->paginate(config('settings.search-view'));
        $albums = $this->albumRepository->searchAlbumHome($input)->paginate(config('settings.search-view'));
        $singers = $this->singerRepository->searchSingerHome($input)->paginate(config('settings.search-view'));

        return view('user.search.search_home', compact('input', 'audios', 'videos', 'albums', 'singers'));
    }
}
