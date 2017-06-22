@extends('user.master')

@section('content')
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.album2') }}{{ ($albums->count()) ? $albums[0]->category->name : trans('home.has-not-music') }}</h3>
    </div>
    @foreach ($albums as $album)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showAlbum', $album['id']) }}" title="{{ $album->name }}">
            <img src="{{ ($album->hasCoverAlbum()) ? config('settings.album_cover_path') . $album->cover : config('settings.album_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAlbum', $album['id']) }}" title="{{ $album->name }}">
            <div class="music-name">{{ $album->name }}</div>
        </a>
    </div>
    @endforeach
    <div class="col-md-12">{{ $albums->links() }}</div>
@endsection
