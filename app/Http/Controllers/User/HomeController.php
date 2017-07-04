<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Album\AlbumRepositoryInterface;
use App\Repositories\Singer\SingerRepositoryInterface;
use App\Repositories\Lyric\LyricRepositoryInterface;
use App\Repositories\View\ViewRepositoryInterface;

class HomeController extends Controller
{

    protected $songRepository;
    protected $albumRepository;
    protected $singerRepository;
    protected $lyricRepository;
    protected $viewRepository;

    public function __construct(
        SongRepositoryInterface $songRepository,
        AlbumRepositoryInterface $albumRepository,
        SingerRepositoryInterface $singerRepository,
        LyricRepositoryInterface $lyricRepository,
        ViewRepositoryInterface $viewRepository
    ) {
        $this->songRepository = $songRepository;
        $this->albumRepository = $albumRepository;
        $this->singerRepository = $singerRepository;
        $this->lyricRepository = $lyricRepository;
        $this->viewRepository = $viewRepository;
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
        $audios = $this->songRepository->getAudioOfTopic($categoryId)->paginate(config('settings.list_item'));;

        return view('user.category_detail.audio', compact('audios'));
    }

    public function showVideoOfTopic($categoryId)
    {
        $videos = $this->songRepository->getVideoOfTopic($categoryId)->paginate(config('settings.list_item'));;

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
        $audios->appends(['search' => $input]);
        $videos->appends(['search' => $input]);
        $albums->appends(['search' => $input]);
        $singers->appends(['search' => $input]);
        return view('user.search.search_home', compact('input', 'audios', 'videos', 'albums', 'singers'));
    }

    public function suggestLyric(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->only('user_id', 'song_id', 'content');
            try {
                $lyric = $this->lyricRepository->create($input);
                $result = [
                    'success' => true,
                ];
            } catch (Exception $e) {
                $result = [
                    'success' => false,
                    'message' => trans('home.comment_fail'),
                ];
                return response()->json($result);
            }
            return response()->json($result);
        }
        return redirect()->back();
    }

    public function searchAjax(Request $request)
    {
        $input = $request['keyword'];
        if ($request->ajax()) {
            $input = $request['keyword'];
            $searchAudios = $this->songRepository->searchAudioHome($input)->paginate(config('settings.search-2'));
            $searchVideos = $this->songRepository->searchVideoHome($input)->paginate(config('settings.search-2'));
            $searchAlbums = $this->albumRepository->searchAlbumHome($input)->paginate(config('settings.search-2'));
            $searchSingers = $this->singerRepository->searchSingerHome($input)->paginate(config('settings.search-2'));
            $htmlSearch = view('user.search.ajax', compact(
                'input',
                'searchAudios',
                'searchVideos',
                'searchAlbums',
                'searchSingers'
            ))->render();
            $result = [
                    'success' => true,
                    'input' => $input,
                    'search_result' => $htmlSearch,
            ];

            return response()->json($result);
        }
    }

    public function playRateTop()
    {
        $audios = $this->songRepository->getTopRateAudio()->paginate(config('settings.top_count'));

        return view('user.music_detail.top', compact('audios'));
    }

    public function updateViewCount(Request $request)
    {
        if ($request->ajax()) {
            $songId = $request['song_id'];
            $this->viewRepository->updateViewCount($songId);
            $result = [
                    'success' => true,
            ];

            return response()->json($result);
        }
    }

    public function playViewTopWeek()
    {
        $views = $this->viewRepository->getTopViewWeekAudio()->paginate(config('settings.top_count'));

        return view('user.music_detail.top_view', compact('views'));
    }

    public function playViewTopMonth()
    {
        $views = $this->viewRepository->getTopViewMonthAudio()->paginate(config('settings.top_count'));

        return view('user.music_detail.top_view', compact('views'));
    }

    public function playViewTopAll()
    {
        $views = $this->viewRepository->getTopViewAllAudio()->paginate(config('settings.top_count'));

        return view('user.music_detail.top_view', compact('views'));
    }
}
