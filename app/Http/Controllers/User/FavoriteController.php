<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Favorite\FavoriteRepositoryInterface;
use App\Repositories\Song\SongRepositoryInterface;

class FavoriteController extends Controller
{

    protected $favoriteRepository;
    protected $songRepository;

    public function __construct(
        FavoriteRepositoryInterface $favoriteRepository,
        SongRepositoryInterface $songRepository
    ) {
        $this->favoriteRepository = $favoriteRepository;
        $this->songRepository = $songRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.favorite.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $favorite = $this->favoriteRepository->createFavorite($request->all());

        if (!$favorite) {
            return redirect()->action('User\UserController@myMusic')->with([
                'flash_level' => 'warning',
                'flash_message' => trans('user.user_update_fail'),
            ]);
        }

        return redirect()->action('User\UserController@myMusic')->with([
                'flash_level' => 'success',
                'flash_message' => trans('user.user_update_success'),
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favorite = $this->favoriteRepository->find($id);
        $audios = $this->songRepository->getListAudioOfFavorite($id);
        $favoriteOfUsers = $this->favoriteRepository->getListFavorite()->paginate(config('settings.list_per_page'));

        return view('user.favorite.show', compact(
            'favorite',
            'audios',
            'favoriteOfUsers'
        ));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createFavoriteDetail(Request $request, $id)
    {
        $favoriteDetail = $this->favoriteRepository->createFavoriteDetail($id, $request->all());

        if (!$favoriteDetail) {
            return redirect()->back()->with([
                'flash_level' => 'warning',
                'flash_message' => trans('home.song-had-in-playlist'),
            ]);
        }

        return redirect()->back()->with([
            'flash_level' => 'success',
            'flash_message' => trans('home.add-success'),
        ]);
    }

    public function removeSong(Request $request, $id)
    {
        $favoriteDetail = $this->favoriteRepository->removeSongFromPlaylist($id, $request->all());

        if (!$favoriteDetail) {
            return redirect()->back()->with([
                'flash_level' => 'warning',
                'flash_message' => trans('home.remove-fail'),
            ]);
        }

        return redirect()->back()->with([
            'flash_level' => 'success',
            'flash_message' => trans('home.remove-success'),
        ]);
    }
}
