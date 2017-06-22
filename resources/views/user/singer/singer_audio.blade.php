@extends('user.singer.singer')

@section('audio-singer')
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.audio2') }}<span class="text-success">{{ ($audios->count()) ? $audios[0]->singer->name : trans('home.has-not-music') }}</h3>
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
    <div class="col-md-12">{{ $audios->links() }}</div>
@endsection
