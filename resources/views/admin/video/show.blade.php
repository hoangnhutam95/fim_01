@extends('admin.master')

@section('style')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('bower_components/plyr/dist/plyr.css') !!}
    {!! Html::style('css/video-media.css') !!}
@endsection
@section('script')
    {!! Html::script('bower_components/plyr/dist/plyr.js') !!}
    {!! Html::script('js/media.js') !!}
    {!! Html::script('js/show-more.js') !!}
@endsection
@section('content')
    @if (Session::has('errors'))
        <div class="alert alert-danger">
            {{ Session::get('errors') }}
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="video-cover">
        <div class="admin-video-name">
            {{ trans('song.song') }}
            <span id="video-name-color">{{ $video->name }}</span>
            <span> - {{ ($video->singer_id) ? $video->singer->name : config('settings.null') }}</span>
        </div>
        <video poster="{{ ($video->hasCoverVideo()) ? config('settings.video_cover_path') . $video->cover : config('settings.video_cover_path') . config('settings.video_default') }}" controls preload loop>
        <source src="{{ config('settings.video_path') . $video->link }}" type="video/mp4">
        </video>
    </div>
    <div class="member-entry cover-song">
        <div class="member-details">
            <div class="col-lg-10">
                <h4><div class="text-primary">{{ $video->name }}</div></h4>
            </div>
            <div class="pull-right">
                {!! Form::open([
                    'action' => ['Admin\VideoController@destroy', $video['id']],
                    'method' => 'delete',
                    'class' => 'fixform',
                ]) !!}
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                    'class' => 'btn btn-block btn-danger btn-xs delete-button',
                    'type' => 'submit',
                ]) !!}
                {{ Form::close() }}
            </div>
            <div class="pull-right">
                <a href="{{ action('Admin\VideoController@edit', $video->id) }}" class="btn btn-block btn-primary btn-xs">
                    <i class="glyphicon glyphicon-edit">{{ trans('song.edit') }}</i>
                </a>
            </div>
            <div class="pull-right">
                <a href="{{ action('Admin\VideoController@show', $video->id) }}" class="btn btn-block btn-success btn-xs">
                    <i class="glyphicon glyphicon-edit">{{ trans('song.update-lyric') }}</i>
                </a>
            </div>
            <div class="row info-list">
                <div class="col-lg-4">
                    <span>{{ trans('song.singer') }}</span>
                    <span class="text-primary">{{ $video->singer_id ? $video->singer->name : config('settings.null') }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.composed') }}</span>
                    <span class="text-primary">{{ $video->author ?: config('settings.null') }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.category') }}</span>
                    <span class="text-primary">{{ ($video->category) ? $video->category->name : config('settings.null') }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.rate_point') }}</span>
                    <span class="text-primary">{{ $video->rate_point }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.rate_number') }}</span>
                    <span class="text-primary">{{ $video->rate_number }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.comment_number') }}</span>
                    <span class="text-primary">{{ $video->comment_number }}</span>
                </div>
                <div class="col-lg-12">
                    <span>{{ trans('song.description') }}</span>
                    <span class="more">{{ ($video->description) ?: config('settings.null') }}</span>
                </div>
                <div class="col-lg-12">
                    <span>{{ trans('song.lyric') }}</span>
                    <span class="more">{{ ($currentLyric) ? $currentLyric->content : config('settings.null') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
