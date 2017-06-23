@extends('admin.master')

@section('style')
    {!! Html::style('css/manage-user.css') !!}
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
    <div class="row bootstrap snippets">
        <div class="col-md-9 col-sm-7">
            <h2>{{ trans('singer.profile') }}</h2>
        </div>
    </div>
    <div class="member-entry">
        <a href="{{ action('Admin\SingerController@edit', $singer->id) }}" class="member-img">
            {{ Html::image(($singer->hasAvatar()) ? config('settings.avatar') . $singer->avatar : config('settings.avatar') . config('settings.avatar_default'), trans('singer.this-is-avatar'), [
                    'class' => 'img-rounded',
            ]) }}
        </a>
        <div class="member-details">
            <h4>
                <a href="{{ action('Admin\SingerController@edit', $singer->id) }}">{{ $singer->name }}</a>
            </h4>
            <div class="row info-list">
                <div class="col-lg-4"><h5>
                    <span>{{ trans('singer.role-2') }}</span>
                    <span class="text-primary">{{ $singer->getRole() }}</span>
                </h5></div>
                <div class="col-lg-4"><h5>
                    <span>{{ trans('singer.audio-count') }}</span>
                    <span class="text-primary">{{ $audiosOfSinger->total() }}</span>
                </h5></div>
                <div class="col-lg-4"><h5>
                    <span>{{ trans('singer.video-count') }}</span>
                    <span class="text-primary">{{ $videosOfSinger->total() }}</span>
                </h5></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><h3>{{ trans('singer.list-audio') }}</h3></th>
                </tr>
            </thead>
            <tbody>

            @if (!$audiosOfSinger->total())
            <tr><td><h4>{{ trans('singer.not-audio')}}</h4></td></tr>
            @endif

            @foreach ($audiosOfSinger as $audioOfSinger)
                <tr><td><h4>
                    <a href="{{ action('Admin\AudioController@show', $audioOfSinger->id) }}">{{ $audioOfSinger->name }}</a>
                </h4></td></tr>
            @endforeach
            <tr><td><div>{{ $audiosOfSinger->render() }}</div></td></tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><h3>{{ trans('singer.list-audio') }}</h3></th>
                </tr>
            </thead>
            <tbody>

            @if (!$videosOfSinger->total())
            <tr><td><h4>{{ trans('singer.not-audio')}}</h4></td></tr>
            @endif

            @foreach ($videosOfSinger as $videoOfSinger)
                <tr><td><h4>
                    <a href={{ action('Admin\VideoController@show', $videoOfSinger->id) }}>{{ $videoOfSinger->name }}</a>
                </h4></td></tr>
            @endforeach
            <tr><td><div>{{ $videosOfSinger->render() }}</div></td></tr>
            </tbody>
        </table>
    </div>
@endsection
