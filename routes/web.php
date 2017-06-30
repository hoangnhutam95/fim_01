<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('/', 'User\HomeController');

Route::get('audio/{audioId}', 'User\MusicController@showAudio');

Route::get('video/{videoId}', 'User\MusicController@showVideo');

Route::get('album/{albumId}', 'User\MusicController@showAlbum');

Route::get('list-audio/{categoryId}', 'User\HomeController@showSongOfTopic');

Route::get('list-video/{categoryId}', 'User\HomeController@showVideoOfTopic');

Route::get('list-album/{categoryId}', 'User\HomeController@showAlbumOfTopic');

Route::get('hot-audio', 'User\HomeController@showHotAudio');

Route::get('hot-video', 'User\HomeController@showHotVideo');

Route::get('hot-album', 'User\HomeController@showHotAlbum');

Route::get('singer', 'User\SingerController@index');

Route::get('singer/{singerId}', 'User\SingerController@show');

Route::get('singer-audio/{singerId}', 'User\SingerController@showAudio');

Route::get('singer-video/{singerId}', 'User\SingerController@showVideo');

Route::match(['get', 'post'], '/search', 'User\HomeController@search');

Route::get('/search-home', 'User\HomeController@searchAjax');

Route::post('/view-count', 'User\HomeController@updateViewCount');

Route::get('/rate-top-list', 'User\HomeController@playRateTop');

Route::group(['middleware' => 'auth'], function () {
    Route::post('rate-song', 'User\RateController@storeRateSong');
    Route::post('rate-album', 'User\RateController@storeRateAlbum');
    Route::resource('comment', 'User\CommentController');
    Route::post('/editComment', 'User\CommentController@updateComment' );
    Route::post('/deleteComment', 'User\CommentController@deleteComment' );
    Route::post('suggest-lyric', 'User\HomeController@suggestLyric');
    Route::get('my-music', 'User\UserController@myMusic');
    Route::get('my-music/edit-profile', 'User\UserController@edit');
    Route::post('my-music/update-profile', 'User\UserController@update');
    Route::resource('my-music/playlist', 'User\FavoriteController');
    Route::post('favorite/{favoriteId}', 'User\FavoriteController@createFavoriteDetail');
    Route::post('favorite/remove-song/{favoriteId}', 'User\FavoriteController@removeSong');
});

Auth::routes();

Route::get('/home', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('home', function () {
        return view('admin.master');
    });
    Route::resource('user', 'Admin\UserController');
    Route::resource('audio', 'Admin\AudioController');
    Route::resource('video', 'Admin\VideoController');
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('singer', 'Admin\SingerController');
    Route::resource('lyric', 'Admin\LyricController');
    Route::resource('album', 'Admin\AlbumController');
    Route::get('/search-audio', 'Admin\AudioController@searchAudio');
    Route::get('/search-video', 'Admin\VideoController@searchVideo');
    Route::match(['get', 'post'], '/search-singer', 'Admin\SingerController@searchSinger');
    Route::match(['get', 'post'], '/search-lyric', 'Admin\LyricController@searchLyric');
    Route::match(['get', 'post'], '/search-album', 'Admin\AlbumController@searchAlbum');
    Route::get('update-lyric/{songId}', 'Admin\LyricController@showListLyric');
    Route::delete('remote-song-in-album/{albumDetailId}', 'Admin\AlbumController@removeSong');
    Route::match(['get', 'post'], 'album/{albumId}/search-song-import', 'Admin\AlbumController@searchSong');
    Route::put('album/{albumId}/import-song-to-album', 'Admin\AlbumController@createAlbumDetail');
    Route::get('hot-audio', 'Admin\HotController@hotAudio');
    Route::get('hot-video', 'Admin\HotController@hotVideo');
    Route::get('hot-album', 'Admin\HotController@hotAlbum');
    Route::match(['get', 'post'], 'hot/search-audio', 'Admin\HotController@searchNotHotAudio');
    Route::match(['get', 'post'], 'hot/search-video', 'Admin\HotController@searchNotHotVideo');
    Route::match(['get', 'post'], 'hot/search-album-not-hot', 'Admin\HotController@searchNotHotAlbum');
    Route::delete('hot/set-not-hot-song/{songId}', 'Admin\HotController@setNotHot');
    Route::delete('hot/set-not-hot-album/{albumId}', 'Admin\HotController@setNotHotAlbum');
    Route::post('hot/set-hot-song/{songId}', 'Admin\HotController@setHot');
    Route::post('hot/set-hot-album/{albumId}', 'Admin\HotController@setHotAlbum');
});
