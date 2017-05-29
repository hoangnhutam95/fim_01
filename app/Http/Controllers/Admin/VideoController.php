<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Singer\SingerRepositoryInterface;
use App\Http\Requests\CreateVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Repositories\Lyric\LyricRepositoryInterface;

class VideoController extends Controller
{
    protected $songRepository;
    protected $categoryRepository;

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
        $videos = $this->songRepository->getListVideos()->paginate(config('settings.video_per_page'));

        return view('admin.video.index', compact('videos'));
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

        return view('admin.video.add', compact('categories', 'singers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVideoRequest $request)
    {
        try {
            $video = $this->songRepository->createVideo($request->all());

            return redirect()->route('video.index')->with('success', trans('song.video_create_success'));
        } catch (Exception $e) {
            return redirect()->route('video.index')->with('errors', trans('song.video_create_fail'));
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
        $video = $this->songRepository->find($id);
        if (!$video) {
            return redirect()->route('video.index')->with('errors', trans('song.video_not_found'));
        }

        return view('admin.video.show', compact('video', 'currentLyric'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = $this->songRepository->find($id);
        $none['0'] = config('settings.none');
        $categories = $this->categoryRepository->getListSongCategories();
        $categories = $none + $categories;
        $singers = $this->singerRepository->getListSingers();
        $singers = $none + $singers;
        if (!$video) {
            return redirect()->route('video.index')->with('errors', trans('song.video_not_found'));
        }

        return view('admin.video.edit', compact('video', 'categories', 'singers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, $id)
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
        $song = $this->songRepository->updateVideo($input, $id);
        if (!$song) {
            return redirect()->route('video.index')->with('errors', trans('song.video_update_fail'));
        }

        return redirect()->route('video.index')->with('success', trans('song.video_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = $this->songRepository->deleteVideo($id);
        if (!$video) {
            return redirect()->route('video.index')->with('errors', trans('song.delete_video_fail'));
        }

        return redirect()->back()->with('success', trans('song.delete_video_successfully'));
    }

    public function searchVideo(Request $request)
    {
        if ($request->ajax()) {
            $input = $request['keyword'];
            $videos = $this->songRepository->searchVideo($input)->paginate(config('settings.video_per_page'));
            $htmlSearch = view('admin.video.search', compact('videos', 'input'))->render();
            $result = [
                    'success' => true,
                    'input' => $input,
                    'search_result' => $htmlSearch,
            ];

            return response()->json($result);
        }
    }
}
