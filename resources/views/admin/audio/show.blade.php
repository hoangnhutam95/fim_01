@extends('admin.master')

@section('style')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('bower_components/plyr/dist/plyr.css') !!}
    {!! Html::style('css/audio-media.css') !!}
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
    <div class="audio-cover" backgr={{ ($audio->hasCoverAudio()) ? config('settings.audio_cover_path') . $audio->cover : $audios->cover }}>
        <div class="admin-audio-name">
            {{ trans('song.song') }}
            <span id="audio-name-color">{{ $audio->name }}</span>
        </div>
        <audio controls preload loop>
            <source src="{{ config('settings.audio_path') . $audio->link }}" type="audio/mpeg">
            {{ trans('song.brower_not_support') }}
        </audio>
    </div>
    <div class="member-entry">
        <div class="member-details">
            <div class="col-lg-10">
                <h4><div class="text-primary">{{ $audio->name }}</div></h4>
            </div>
            <div class="pull-right">
                {!! Form::open([
                    'action' => ['Admin\AudioController@destroy', $audio['id']],
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
                <a href="{{ action('Admin\AudioController@edit', $audio->id) }}" class="btn btn-block btn-primary btn-xs">
                    <i class="glyphicon glyphicon-edit">{{ trans('song.edit') }}</i>
                </a>
            </div>
            <div class="pull-right">
                <a href="{{ action('Admin\LyricController@showListLyric', $audio->id) }}" class="btn btn-block btn-success btn-xs">
                    <i class="glyphicon glyphicon-edit">{{ trans('song.update-lyric') }}</i>
                </a>
            </div>
            <div class="row info-list">
                <div class="col-lg-4">
                    <span>{{ trans('song.singer') }}</span>
                    <span class="text-primary">{{ $audio->singer_id ? $audio->singer->name : config('settings.null') }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.composed') }}</span>
                    <span class="text-primary">{{ $audio->author ?: config('settings.null') }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.category') }}</span>
                    <span class="text-primary">{{ ($audio->category) ? $audio->category->name : config('settings.null') }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.rate_point') }}</span>
                    <span class="text-primary">{{ $audio->rate_point }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.rate_number') }}</span>
                    <span class="text-primary">{{ $audio->rate_number }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('song.comment_number') }}</span>
                    <span class="text-primary">{{ $audio->comment_number }}</span>
                </div>
                <div class="col-lg-12">
                    <span>{{ trans('song.description') }}</span>
                    <span>{{ ($audio->description) ?: config('settings.null') }}</span>
                </div>
                <div class="col-lg-12">
                    <span>{{ trans('song.lyric') }}</span>
                    <span>{{ ($currentLyric) ? $currentLyric->content : config('settings.null') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
