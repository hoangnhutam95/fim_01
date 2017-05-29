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
});
