<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Album\AlbumRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Song\SongRepositoryInterface;

class AlbumController extends Controller
{
    protected $albumRepository;
    protected $categoryRepository;
    protected $songRepository;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        CategoryRepositoryInterface $categoryRepository,
        SongRepositoryInterface $songRepository
    ) {
        $this->albumRepository = $albumRepository;
        $this->categoryRepository = $categoryRepository;
        $this->songRepository = $songRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = $this->albumRepository->paginate(config('settings.album_per_page'));

        return view('admin.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $none['0'] = config('settings.none');
        $categories = $this->categoryRepository->getListAlbumCategories();
        $categories = $none + $categories;

        return view('admin.album.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $album = $this->albumRepository->createAlbum($request->all());

            return redirect()->route('album.index')->with('success', trans('album.album_create_success'));
        } catch (Exception $e) {
            return redirect()->route('album.index')->with('errors', trans('album.album_create_fail'));
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
        $album = $this->albumRepository->find($id);
        if (!$album) {
            return redirect()->route('album.index')->with('errors', trans('album.album_not_found'));
        }

        return view('admin.album.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = $this->albumRepository->find($id);
        $none['0'] = config('settings.none');
        $categories = $this->categoryRepository->getListAlbumCategories();
        $categories = $none + $categories;
        if (!$album) {
            return redirect()->route('audio.index')->with('errors', trans('song.audio_not_found'));
        }

        return view('admin.album.edit', compact('album', 'categories'));
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
        $input = $request->only(
            'name',
            'category_id',
            'cover',
            'current_img'
        );
        $album = $this->albumRepository->updateAlbum($input, $id);
        if (!$album) {
            return redirect()->route('album.index')->with('errors', trans('album.album_update_fail'));
        }

        return redirect()->route('album.index')->with('success', trans('album.album_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = $this->albumRepository->deleteAlbum($id);
        if (!$album) {
            return redirect()->back()->with('errors', trans('album.delete_album_fail'));
        }

        return redirect()->route('album.index')->with('success', trans('album.delete_album_successfully'));
    }

    public function searchAlbum(Request $request)
    {
        $input = $request['search'];
        $albums = $this->albumRepository->searchAlbum($input)->paginate(config('settings.album_per_page'));
        $albums->appends(['search' => $input]);

        return view('admin.album.index', compact('albums', 'input'));
    }

    public function removeSong($albumDetailId)
    {
        $albumDetail = $this->albumRepository->removeSongFromAlbum($albumDetailId);
        if (!$albumDetail) {
            return redirect()->back()->with('errors', trans('album.remove_song_fail'));
        }

        return redirect()->back()->with('success', trans('album.remove_song_successfully'));
    }

    public function searchSong(Request $request, $id)
    {
        $input = $request['search'];
        $songs = $this->albumRepository->searchAudioImportToAlbum($input, $id);
        $songs->appends(['search' => $input]);
        $album = $this->albumRepository->find($id);
        if (!$album) {
            return redirect()->route('album.index')->with('errors', trans('album.album_not_found'));
        }

        return view('admin.album.show', compact('songs', 'input', 'album'));
    }

    public function createAlbumDetail(Request $request, $id)
    {
        $input = $request['song_id'];
        $albumDetail = $this->albumRepository->createAlbumDetail($input, $id);
        if (!$albumDetail) {
            return redirect()->back()->with('errors', trans('album.import_song_fail'));
        }

        return redirect()->back()->with('success', trans('album.import_song_successfully'));
    }
}
