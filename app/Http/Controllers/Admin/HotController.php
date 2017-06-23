<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Album\AlbumRepositoryInterface;
use App\Repositories\Song\SongRepositoryInterface;

class HotController extends Controller
{
    protected $albumRepository;
    protected $songRepository;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        SongRepositoryInterface $songRepository
    ) {
        $this->albumRepository = $albumRepository;
        $this->songRepository = $songRepository;
    }

    public function hotAudio()
    {
        $audios = $this->songRepository->getHotAudio()->get();

        return view('admin.hot.audio', compact('audios'));
    }

    public function setNotHot($songId)
    {
        $song = $this->songRepository->setNotHot($songId);
        if (!$song) {
            return redirect()->back()->with('errors', trans('hot.set-fail'));
        }

        return redirect()->back()->with('success', trans('hot.set-success'));
    }

    public function setHot($songId)
    {
        $song = $this->songRepository->setHot($songId);
        if (!$song) {
            return redirect()->back()->with('errors', trans('hot.set-fail'));
        }

        return redirect()->back()->with('success', trans('hot.set-success'));
    }

    public function searchNotHotAudio(Request $request)
    {
        $input = $request['search'];
        $songs = $this->songRepository->searchNotHotAudio($input)->paginate(config('settings.search-view'));
        $audios = $this->songRepository->getHotAudio()->get();
        $songs->appends(['search' => $input]);

        return view('admin.hot.audio', compact('audios', 'songs', 'input'));
    }

    public function hotVideo()
    {
        $videos = $this->songRepository->getHotVideo()->get();

        return view('admin.hot.video', compact('videos'));
    }

    public function searchNotHotVideo(Request $request)
    {
        $input = $request['search'];
        $songs = $this->songRepository->searchNotHotVideo($input)->paginate(config('settings.search-view'));
        $videos = $this->songRepository->getHotVideo()->get();
        $songs->appends(['search' => $input]);

        return view('admin.hot.video', compact('videos', 'songs', 'input'));
    }

    public function hotAlbum()
    {
        $albums = $this->albumRepository->getHotAlbum()->get();

        return view('admin.hot.album', compact('albums'));
    }

    public function setHotAlbum($albumId)
    {
        $album = $this->albumRepository->setHotAlbum($albumId);
        if (!$album) {
            return redirect()->back()->with('errors', trans('hot.set-fail'));
        }

        return redirect()->back()->with('success', trans('hot.set-success'));
    }

    public function setNotHotAlbum($albumId)
    {
        $album = $this->albumRepository->setNotHotAlbum($albumId);
        if (!$album) {
            return redirect()->back()->with('errors', trans('hot.set-fail'));
        }

        return redirect()->back()->with('success', trans('hot.set-success'));
    }

    public function searchNotHotAlbum(Request $request)
    {
        $input = $request['search'];
        $albumNotHots = $this->albumRepository->searchNotHotAlbum($input)->paginate(config('settings.search-view'));
        $albums = $this->albumRepository->getHotAlbum()->get();
        $albumNotHots->appends(['search' => $input]);

        return view('admin.hot.album', compact('albums', 'albumNotHots', 'input'));
    }
}
