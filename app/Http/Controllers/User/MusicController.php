<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Singer\SingerRepositoryInterface;
use App\Repositories\Lyric\LyricRepositoryInterface;
use App\Repositories\Album\AlbumRepositoryInterface;

class MusicController extends Controller
{
    protected $songRepository;
    protected $categoryRepository;
    protected $singerRepository;
    protected $lyricRepository;
    protected $albumRepository;

    public function __construct(
        SongRepositoryInterface $songRepository,
        CategoryRepositoryInterface $categoryRepository,
        SingerRepositoryInterface $singerRepository,
        LyricRepositoryInterface $lyricRepository,
        AlbumRepositoryInterface $albumRepository
    ) {
        $this->songRepository = $songRepository;
        $this->categoryRepository = $categoryRepository;
        $this->singerRepository = $singerRepository;
        $this->lyricRepository = $lyricRepository;
        $this->albumRepository = $albumRepository;
    }

    public function showAudio($id)
    {
        $currentLyric = $this->lyricRepository->getSongLyric($id);
        $audio = $this->songRepository->find($id);
        if ($audio->singer_id) {
            $audiosOfSinger = $this->songRepository
                ->getAudioOfSinger($audio->singer_id)
                ->paginate(config('settings.list_per_page'));
            $videosOfSinger = $this->songRepository
                ->getVideoOfSinger($audio->singer_id)
                ->paginate(config('settings.list_per_page'));
        }

        return view('user.music_detail.audio', compact('audio', 'currentLyric', 'audiosOfSinger', 'videosOfSinger'));
    }

    public function showVideo($id)
    {
        $currentLyric = $this->lyricRepository->getSongLyric($id);
        $video = $this->songRepository->find($id);
        if ($video->singer_id) {
            $videosOfSinger = $this->songRepository
                ->getVideoOfSinger($video->singer_id)
                ->paginate(config('settings.list_per_page'));
            $audiosOfSinger = $this->songRepository
                ->getAudioOfSinger($video->singer_id)
                ->paginate(config('settings.list_per_page'));
        }

        return view('user.music_detail.video', compact('video', 'currentLyric', 'videosOfSinger', 'videosOfSinger'));
    }

    public function showAlbum($id)
    {
        $album = $this->albumRepository->find($id);
        $audios = $this->songRepository->getListAudioOfAlbum($id);
        if ($album->category_id) {
            $albumOfTopics = $this->albumRepository
                ->getCategoryOfAlbum($album->category_id)
                ->paginate(config('settings.list_per_page'));
        }
        if (!$album && !$audios) {
            return redirect()->back()->with('errors', trans('album.album_not_found'));
        }

        return view('user.music_detail.album', compact('album', 'audios', 'albumOfTopics'));
    }
}
