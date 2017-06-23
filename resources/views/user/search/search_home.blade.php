@extends('user.master')

@section('content')
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.search-keyword') }}{{ $input }}</h3>
    </div>
    @if (isset($audios) && $audios->count())
        <div class="col-lg-12">
            <h3 class="page-header">{{ trans('home.audio') }}</h3>
        </div>
        @foreach ($audios as $audio)
        <div class="col-sm-3 list">
            <a href="{{ action('User\MusicController@showAudio', $audio['id']) }}" title="{{ $audio->name }}">
                <img src="{{ ($audio->hasCoverAudio()) ? config('settings.audio_cover_path') . $audio->cover : config('settings.audio_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
            </a>
            <a href="{{ action('User\MusicController@showAudio', $audio['id']) }}" title="{{ $audio->name }}">
                <div class="music-name">{{ $audio->name }}</div>
            </a>
            <a href="{{ $audio->singer_id ? action('User\SingerController@show', $audio->singer_id) : null }}" class="">
                <div class="singer-name">{{ ($audio->singer_id) ? $audio->singer->name : config('settings.null') }}</div>
            </a>
        </div>
        @endforeach
    @endif
    @if (isset($videos) && $videos->count())
        <div class="col-sm-12">
            <h3 class="page-header">{{ trans('home.video') }}</h3>
        </div>
        @foreach ($videos as $video)
        <div class="col-sm-3 list">
            <a href="{{ action('User\MusicController@showVideo', $video['id']) }}" title="{{ $video->name }}">
                <img src="{{ ($video->hasCoverVideo()) ? config('settings.video_cover_path') . $video->cover : config('settings.video_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
            </a>
            <a href="{{ action('User\MusicController@showVideo', $video['id']) }}" title="{{ $video->name }}">
                <div class="music-name">{{ $video->name }}</div>
            </a>
            <a href="{{ $video->singer_id ? action('User\SingerController@show', $video->singer_id) : null }}" class="">
                <div class="singer-name">{{ ($video->singer_id) ? $video->singer->name : config('settings.null') }}</div>
            </a>
        </div>
        @endforeach
    @endif
    @if (isset($albums) && $albums->count())
        <div class="col-sm-12">
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
    @endif
    @if (isset($singers) && $singers->count())
        <div class="col-sm-12">
            <h3 class="page-header">{{ trans('home.list-singer') }}</h3>
        </div>
        @foreach ($singers as $singer)
            <div class="col-sm-12">
                <a href="{{ action('User\SingerController@show', $singer['id']) }}" class="name">{{ $singer->name }}</a>
            </div>
        @endforeach
    @endif
    @if (!$audios->count() && !$videos->count() && !$albums->count() && !$singers->count())
        <h2>{{ trans('home.no_result') }}</h2>
    @endif
@endsection
