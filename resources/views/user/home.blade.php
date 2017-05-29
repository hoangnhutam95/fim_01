@extends('user.master')

@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($newAudios as $newAudio)
                @if ($newAudio == $newAudios[0])
                <li data-target="#myCarousel" class="active"></li>
                @else
                <li data-target="#myCarousel"></li>
                @endif
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach ($newAudios as $newAudio)
                @if ($newAudio == $newAudios[0])
                <div class="item active">
                @else
                <div class="item">
                @endif
                    <img src="{{ ($newAudio->hasCoverAudio()) ? config('settings.audio_cover_path') . $newAudio->cover : $newAudio->cover }}" width="1200" height="700">
                    <div class="carousel-caption">
                        <a href="{{ action('User\MusicController@showAudio', $newAudio['id']) }}">
                            <h3 class="back-name">{{ $newAudio->name }}</h3>
                        </a>
                        <p>{{ ($newAudio->singer_id) ? $newAudio->singer->name : config('settings.null') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">{{ trans('home.preview') }}</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">{{ trans('home.next') }}</span>
        </a>
    </div>
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.hot-music') }}</h3>
    </div>
    @foreach ($hotAudios as $hotAudio)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showAudio', $hotAudio['id']) }}" class="" title="{{ $hotAudio->name }}">
            <img src="{{ ($hotAudio->hasCoverAudio()) ? config('settings.audio_cover_path') . $hotAudio->cover : $hotAudio->cover }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAudio', $hotAudio['id']) }}" class="" title="{{ $hotAudio->name }}">
            <div class="music-name">{{ $hotAudio->name }}</div>
        </a>
        <a href="" class="">
            <div class="singer-name">{{ ($hotAudio->singer_id) ? $hotAudio->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.hot-video') }}</h3>
    </div>
    @foreach ($hotVideos as $hotVideo)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showVideo', $hotVideo['id']) }}" class="" title="{{ $hotVideo->name }}">
            <img src="{{ ($hotVideo->hasCoverVideo()) ? config('settings.video_cover_path') . $hotVideo->cover : $hotVideo->cover }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showVideo', $hotVideo['id']) }}" class="" title="{{ $hotVideo->name }}">
            <div class="music-name">{{ $hotVideo->name }}</div>
        </a>
        <a href="" class="">
            <div class="singer-name">{{ ($hotVideo->singer_id) ? $hotVideo->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.hot-album') }}</h3>
    </div>
    @foreach ($hotAlbums as $hotAlbum)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showAlbum', $hotAlbum['id']) }}" class="" title="{{ $hotAlbum->name }}">
            <img src="{{ ($hotAlbum->hasCoverAlbum()) ? config('settings.album_cover_path') . $hotAlbum->cover : $hotAlbum->cover }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAlbum', $hotAlbum['id']) }}" class="" title="{{ $hotAlbum->name }}">
            <div class="music-name">{{ $hotAlbum->name }}</div>
        </a>
        <a href="" class="">
            <div class="singer-name">{{ ($hotAlbum->singer_id) ? $hotAlbum->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
@endsection
