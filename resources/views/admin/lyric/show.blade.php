@extends('admin.master')

@section('style')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('bower_components/plyr/dist/plyr.css') !!}
    {!! Html::style('css/video-media.css') !!}
    {!! Html::style('css/audio-media.css') !!}
@endsection

@section('script')
    {!! Html::script('bower_components/plyr/dist/plyr.js') !!}
    {!! Html::script('js/media.js') !!}
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
    @if ($lyric->song->type == config('settings.audio'))
        <div class="audio-cover" backgr={{ ($lyric->song->hasCoverAudio()) ? config('settings.audio_cover_path') . $lyric->song->cover : config('settings.audio_cover_path') . config('settings.cover_default') }}>
            <div class="admin-audio-name">
                {{ trans('song.song') }}
                <span id="audio-name-color">{{ $lyric->song->name }}</span>
            </div>
            <audio controls preload loop class="js-player">
                <source src="{{ config('settings.audio_path') . $lyric->song->link }}" type="audio/mpeg">
                {{ trans('song.brower_not_support') }}
            </audio>
        </div>
    @elseif ($lyric->song->type == config('settings.video'))
        <div class="video-cover">
        <div class="admin-video-name">
            {{ trans('song.song') }}
            <span id="video-name-color">{{ $lyric->song->name }}</span>
            <span> - {{ ($lyric->song->singer_id) ? $lyric->song->singer->name : config('settings.null') }}</span>
        </div>
        <video poster="{{ ($lyric->song->hasCoverVideo()) ? config('settings.video_cover_path') . $lyric->song->cover : config('settings.video_cover_path') . config('settings.video_default') }}" controls preload loop>
        <source src="{{ config('settings.video_path') . $lyric->song->link }}" type="video/mp4">
        </video>
    </div>
    @endif
    <div class="row bootstrap snippets">
        <div class="col-md-9 col-sm-7">
            <h2>{{ trans('lyric.user-suggest-lyric') }}</h2>
        </div>
    </div>
    <div class="member-entry">
        <a href="{{ action('Admin\UserController@show', $lyric->user_id) }}" class="member-img">
            {{ Html::image(($lyric->user->hasAvatar()) ? config('settings.avatar') . $lyric->user->avatar : $lyric->user->avatar,
                trans('user.this-is-avatar'), [
                    'class' => 'img-rounded',
            ]) }}
        </a>
        <div class="member-details">
            <div class="col-lg-8">
                <h4><a href="{{ action('Admin\UserController@show', $lyric->user_id) }}">
                    {{ $lyric->user->name }}
                </a></h4>
            </div>
            <div class="pull-right">
                {!! Form::open([
                    'action' => ['Admin\LyricController@destroy', $lyric['id']],
                    'method' => 'delete',
                    'class' => 'fixform',
                ]) !!}
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>' . trans('lyric.delete'), [
                    'class' => 'btn btn-block btn-danger btn-xs delete-button',
                    'type' => 'submit',
                ]) !!}
                {{ Form::close() }}
            </div>
            <div class="row info-list">
                <div class="col-lg-6"><h4>
                    <span>{{ trans('lyric.song-name') }}</span>
                    <span>
                        @if ($lyric->song->type == config('settings.audio'))
                        <a href="{{ action('Admin\AudioController@show', $lyric->song_id) }}">{{ $lyric->song->name }}</a>
                        @elseif ($lyric->song->type == config('settings.video'))
                        <a href="{{ action('Admin\VideoController@show', $lyric->song_id) }}">{{ $lyric->song->name }}</a>
                        @else
                        {{ $lyric->song->name }}
                        @endif
                    </span>
                </h4></div>
                <div class="col-lg-6">
                    <span>{{ trans('lyric.type-song') }}</span>
                    <span class="text-primary">{{ $lyric->song->type }}</span>
                </div>
                <div class="col-lg-3">
                    <span>{{ trans('lyric.created-at') }}</span>
                    <span class="text-primary">{{ $lyric->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><h3>{{ trans('lyric.user-lyric') }}
                        <span>
                            <div class="pull-right">
                            {!! Form::open([
                                'action' => ['Admin\LyricController@update', $lyric->id],
                                'method' => 'PUT',
                            ]) !!}
                            {!! Form::hidden('song_id', $lyric->song_id) !!}
                            {!! Form::button(trans('lyric.accept'), [
                                'class' => 'btn btn-block btn-success btn-xs',
                                'type' => 'submit',
                            ]) !!}
                            {{ Form::close() }}
                            </div>
                        </span>
                    </h3></th>
                </tr>
            </thead>
            <tbody>
                <tr><td>
                    {{ $lyric->content }}
                </td></tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><h3>{{ trans('lyric.current-lyric') }}</h3></th>
                </tr>
            </thead>
            <tbody>

            @if (!isset($currentLyric))
            <tr><td><h4>{{ trans('lyric.no-lyric')}}</h4></td></tr>
            @else
            <tr><td>
                {{ $currentLyric->content }}
            </td></tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
