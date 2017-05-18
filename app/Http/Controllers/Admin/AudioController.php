<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Singer\SingerRepositoryInterface;
use App\Http\Requests\UpdateAudioRequest;
use App\Http\Requests\CreateAudioRequest;

class AudioController extends Controller
{
    protected $songRepository;
    protected $categoryRepository;
    protected $singerRepository;

    public function __construct(
        SongRepositoryInterface $songRepository,
        CategoryRepositoryInterface $categoryRepository,
        SingerRepositoryInterface $singerRepository
    ) {
        $this->songRepository = $songRepository;
        $this->categoryRepository = $categoryRepository;
        $this->singerRepository = $singerRepository;
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
        $categories = $this->categoryRepository->getListCategories();
        $categories->prepend(config('settings.none'));
        $singers = $this->singerRepository->getListSingers();
        $singers->prepend(config('settings.none'));
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
        //
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
        $categories = $this->categoryRepository->getListCategories();
        $categories->prepend(config('settings.none'));
        $singers = $this->singerRepository->getListSingers();
        $singers->prepend(config('settings.none'));
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
            'cover',
            'current_img',
            'link',
            'current_file'
        );
        $song = $this->songRepository->updateAudio($input, $id);
        if (!$song) {
            return redirect()->route('audio.index')->with('errors', trans('song.audio_update_fail'));
        }

        return redirect()->route('audio.index')->with('success', trans('song.audio_update_success'));
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
            return redirect()->back()->with('success', trans('song.delete_audio_successfully'));
        }

        return redirect()->back()->with('errors', trans('song.delete_audio_fail'));
    }
}
