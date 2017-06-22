@extends('user.master')

@section('content')
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.video2') }}{{ ($videos->count()) ? $videos[0]->category->name : trans('home.has-not-music') }}</h3>
    </div>
    @foreach ($videos as $video)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showVideo', $video['id']) }}" title="{{ $video->name }}">
            <img src="{{ ($video->hasCoverVideo()) ? config('settings.video_cover_path') . $video->cover : $video->cover }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showVideo', $video['id']) }}" title="{{ $video->name }}">
            <div class="music-name">{{ $video->name }}</div>
        </a>
        <a href="" class="">
            <div class="singer-name">{{ ($video->singer_id) ? $video->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
    <div class="col-md-12">{{ $videos->links() }}</div>
@endsection
