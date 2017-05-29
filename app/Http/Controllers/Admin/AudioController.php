<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Singer\SingerRepositoryInterface;
use App\Http\Requests\UpdateAudioRequest;
use App\Http\Requests\CreateAudioRequest;
use App\Repositories\Lyric\LyricRepositoryInterface;

class AudioController extends Controller
{
    protected $songRepository;
    protected $categoryRepository;
    protected $singerRepository;
    protected $lyricRepository;

    public function __construct(
        SongRepositoryInterface $songRepository,
        CategoryRepositoryInterface $categoryRepository,
        SingerRepositoryInterface $singerRepository,
        LyricRepositoryInterface $lyricRepository
    ) {
        $this->songRepository = $songRepository;
        $this->categoryRepository = $categoryRepository;
        $this->singerRepository = $singerRepository;
        $this->lyricRepository = $lyricRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audios = $this->songRepository->getListAudios()->paginate(config('settings.audio_per_page'));

        return view('admin.audio.index', compact('audios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $none['0'] = config('settings.none');
        $categories = $this->categoryRepository->getListSongCategories();
        $categories = $none + $categories;
        $singers = $this->singerRepository->getListSingers();
        $singers = $none + $singers;

        return view('admin.audio.add', compact('categories', 'singers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAudioRequest $request)
    {
        try {
            $audio = $this->songRepository->createAudio($request->all());

            return redirect()->route('audio.index')->with('success', trans('song.audio_create_success'));
        } catch (Exception $e) {
            return redirect()->route('audio.index')->with('errors', trans('song.audio_create_fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentLyric = $this->lyricRepository->getSongLyric($id);
        $audio = $this->songRepository->find($id);
        if (!$audio) {
            return redirect()->route('audio.index')->with('errors', trans('song.audio_not_found'));
        }

        return view('admin.audio.show', compact('audio', 'currentLyric'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audio = $this->songRepository->find($id);
        $none['0'] = config('settings.none');
        $categories = $this->categoryRepository->getListSongCategories();
        $categories = $none + $categories;
        $singers = $this->singerRepository->getListSingers();
        $singers = $none + $singers;
        if (!$audio) {
            return redirect()->route('audio.index')->with('errors', trans('song.audio_not_found'));
        }

        return view('admin.audio.edit', compact('audio', 'categories', 'singers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAudioRequest $request, $id)
    {
        $input = $request->only(
            'name',
            'author',
            'category_id',
            'singer_id',
            'description',
            'cover',
            'current_img',
            'link',
            'current_file'
        );
        $song = $this->songRepository->updateAudio($input, $id);
        if (!$song) {
            return redirect()->route('audio.show', $id)->with('errors', trans('song.audio_update_fail'));
        }

        return redirect()->route('audio.show', $id)->with('success', trans('song.audio_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $audio = $this->songRepository->deleteAudio($id);
        if ($audio) {
            return redirect()->route('audio.index')->with('success', trans('song.delete_audio_successfully'));
        }

        return redirect()->back()->with('errors', trans('song.delete_audio_fail'));
    }

    public function searchAudio(Request $request)
    {
        $input = $request['keyword'];
        if ($request->ajax()) {
            $input = $request['keyword'];
            $audios = $this->songRepository->searchAudio($input)->paginate(config('settings.audio_per_page'));
            $htmlSearch = view('admin.audio.search', compact('audios', 'input'))->render();
            $result = [
                    'success' => true,
                    'input' => $input,
                    'search_result' => $htmlSearch,
            ];

            return response()->json($result);
        }
    }
}
