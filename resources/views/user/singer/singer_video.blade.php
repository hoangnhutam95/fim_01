@extends('user.singer.singer')

@section('video-singer')
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.video2') }}{{ ($videos->count()) ? $videos[0]->singer->name : trans('home.has-not-music') }}</h3>
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
    <div class="col-md-12">{{ $videos->links() }}</div>
@endsection
