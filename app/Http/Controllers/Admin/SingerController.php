<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Singer\SingerRepositoryInterface;
use App\Repositories\Song\SongRepositoryInterface;
use App\Http\Requests\SingerRequest;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singers = $this->singerRepository->getSinger()->paginate(config('settings.singer_per_page'));

        return view('admin.singer.index', compact('singers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.singer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SingerRequest $request)
    {
        try {
            $singer = $this->singerRepository->createSinger($request->all());

            return redirect()->route('singer.index')->with('success', trans('singer.singer_create_success'));
        } catch (Exception $e) {
            return redirect()->route('singer.index')->with('errors', trans('singer.singer_create_fail'));
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
        $audiosOfSinger = $this->songRepository->getAudioOfSinger($id)->paginate(config('settings.audio_per_page'));
        $videosOfSinger = $this->songRepository->getVideoOfSinger($id)->paginate(config('settings.video_per_page'));
        $singer = $this->singerRepository->find($id);
        if (!$singer) {
            return redirect()->route('singer.index')->with('errors', trans('singer.singer_not_found'));
        }

        return view('admin.singer.show', compact('singer', 'audiosOfSinger', 'videosOfSinger'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singer = $this->singerRepository->find($id);
        if (!$singer) {
            return redirect()->route('singer.index')->with('errors', trans('singer.singer_not_found'));
        }

        return view('admin.singer.edit', compact('singer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SingerRequest $request, $id)
    {
        $input = $request->only(
            'name',
            'role',
            'avatar',
            'current_img'
        );
        $singer = $this->singerRepository->updateSinger($input, $id);
        if (!$singer) {
            return redirect()->route('singer.index')->with('errors', trans('singer.singer_update_fail'));
        }

        return redirect()->route('singer.index')->with('success', trans('singer.singer_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singer = $this->singerRepository->deleteSinger($id);
        if (!$singer) {
            return redirect()->back()->with('errors', trans('singer.delete_singer_fail'));
        }

        return redirect()->back()->with('success', trans('singer.delete_singer_successfully'));
    }

    public function searchSinger(Request $request)
    {
        $input = $request['search'];
        $singers = $this->singerRepository->searchSinger($input)->paginate(config('settings.singer_per_page'));
        $singers->appends(['search' => $input]);

        return view('admin.singer.index', compact('singers', 'input'));
    }
}
