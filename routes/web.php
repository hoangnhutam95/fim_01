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

Route::get('hot-audio}', 'User\HomeController@showHotAudio');

Route::get('hot-video', 'User\HomeController@showHotVideo');

Route::get('hot-album', 'User\HomeController@showHotAlbum');

Route::group(['middleware' => 'auth'], function () {
    Route::post('rate-song', 'User\RateController@storeRateSong');
    Route::post('rate-album', 'User\RateController@storeRateAlbum');
    Route::resource('comment', 'User\CommentController');
    Route::post('/editComment', 'User\CommentController@updateComment' );
    Route::post('/deleteComment', 'User\CommentController@deleteComment' );
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
});
