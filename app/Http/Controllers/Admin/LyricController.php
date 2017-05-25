<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Lyric\LyricRepositoryInterface;
use App\Repositories\Song\SongRepositoryInterface;

class LyricController extends Controller
{
    protected $lyricRepository;
    protected $songRepository;

    public function __construct(
        LyricRepositoryInterface $lyricRepository,
        SongRepositoryInterface $songRepository
    ) {
        $this->lyricRepository = $lyricRepository;
        $this->songRepository = $songRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lyrics = $this->lyricRepository->getWattingLyric();

        return view('admin.lyric.index', compact('lyrics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lyric = $this->lyricRepository->createLyric($request->all());
        if (!$lyric) {
            return redirect()->back()->with('errors', trans('lyric.lyric_create_fail'));
        }

        return redirect()->back()->with('success', trans('lyric.lyric_create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lyric = $this->lyricRepository->find($id);
        $currentLyric = $this->lyricRepository->getCurrentLyric($id);
        if (!$lyric) {
            return redirect()->route('lyric.index')->with('errors', trans('lyric.lyric_not_found'));
        }

        return view('admin.lyric.show', compact('lyric', 'currentLyric'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $songId = $request['song_id'];
        $song = $this->songRepository->find($songId);
        $lyric = $this->lyricRepository->acceptLyric($id);
        if (!$lyric) {
            return redirect()->route('lyric.index')
                ->with('errors', trans('lyric.lyric_update_fail'));
        }
        if ($song['type'] == config('settings.audio')) {
            return redirect()->route('audio.show', $songId)
                ->with('success', trans('song.audio_update_success'));
        }

        return redirect()->route('video.show', $songId)
            ->with('success', trans('song.audio_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lyric = $this->lyricRepository->delete($id);
        if (!$lyric) {
            return redirect()->back()->with('errors', trans('lyric.delete_lyric_fail'));
        }

        return redirect()->route('lyric.index')->with('success', trans('lyric.delete_lyric_successfully'));
    }

    public function showListLyric($songId)
    {
        $song = $this->songRepository->find($songId);
        $lyrics = $this->lyricRepository->getListLyricOfSong($songId);
        $currentLyric = $this->lyricRepository->getSongLyric($songId);

        return view('admin.lyric.list', compact('lyrics', 'currentLyric', 'song'));
    }

    public function searchLyric(Request $request)
    {
        $keyword = $request['search'];
        $lyrics = $this->lyricRepository->searchSugestLyric($keyword);
        $lyrics->appends(['search' => $keyword]);

        return view('admin.lyric.index', compact('lyrics', 'keyword'));
    }
}
