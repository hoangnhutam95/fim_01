@extends('admin.master')

@section('style')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('bower_components/plyr/dist/plyr.css') !!}
    {!! Html::style('css/audio-media.css') !!}
@endsection
@section('script')
    {!! Html::script('bower_components/plyr/dist/plyr.js') !!}
    {!! Html::script('js/audio-media.js') !!}
@endsection
@section('content')
    <div class="audio-cover" backgr={{ ($audios[0]->hasCoverAudio()) ? config('settings.audio_cover_path') . $audios[0]->cover : $audios[0]->cover }}>
        <div class="admin-audio-name">
            {{ trans('song.song') }}
            <span id="audio-name-color">{{ $audios[0]->name }}</span>
        </div>
        <audio controls preload loop class="test-p" id='audio-view'>
            <source src="{{ config('settings.audio_path') . $audios[0]->link }}" type="audio/mpeg">
            {{ trans('song.brower_not_support') }}
        </audio>
    </div>
    <div class="add-audio">
        <a class="btn btn-primary pull-right" href="{{ action('Admin\AudioController@create') }}">
            <i class="fa fa-plus"></i>{{ trans('song.add-audio') }}
        </a>
    </div>
    <div class="row bootstrap snippets">
        <div class="col-md-9 col-sm-7">
            <h2>{{ trans('song.list-audio') }}</h2>
        </div>
    </div>
        <form method="get" role="form" class="search-form-full">
            <div class="form-group">
                <input type="text" class="form-control" name="s" id="search-input" placeholder="Search...">
                <i class="entypo-search"></i>
            </div>
        </form>
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

    @foreach($audios as $audio)
        {!! Form::open() !!}
            {!! Form::hidden('audio_id', $audio->id, [
                'id' => 'audio-id',
            ]) !!}
            {!! Form::hidden('src', ($audio->hasFileAudio()) ? config('settings.audio_path') . $audio->link : $audio->link, [
                'id' => 'link-audio' . $audio->id,
            ]) !!}
            {!! Form::hidden('cover-audio', ($audio->hasCoverAudio()) ? config('settings.audio_cover_path') . $audio->cover : $audio->cover , [
                'id' => 'cover-audio' . $audio->id,
            ]) !!}
            {!! Form::hidden('audio-name', $audio->name, [
                'id' => 'audio-name' . $audio->id,
            ]) !!}
        {!! Form::close() !!}
        <div class="member-entry cover-song">
            <div class="member-details">
                <div class="col-lg-10">
                    <h4><a href="" class="play-audio" id = {{ $audio->id }}>{{ $audio->name }}</a></h4>
                </div>
                <div class="col-lg-1">
                    <a href="{{ action('Admin\AudioController@edit', $audio->id) }}" class="btn btn-block btn-primary btn-xs">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </div>
                <div class="col-lg-1">
                    {!! Form::open([
                        'action' => ['Admin\AudioController@destroy', $audio['id']],
                        'method' => 'delete',
                        ])
                    !!}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                        'class' => 'btn btn-block btn-danger btn-xs delete-button',
                        'type' => 'submit',
                        ])
                    !!}
                    {{ Form::close() }}
                </div>
                <div class="row info-list">
                    <div class="col-lg-4">
                        <span>{{ trans('song.singer') }}
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
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-12">{{ $audios->links() }}</div>
@endsection
