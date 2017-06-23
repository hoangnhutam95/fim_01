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
            <h2>{{ trans('lyric.list-lyric') }}</h2>
        </div>
        <div class="sidebar-search">
            {!! Form::open([
                'action' => ['Admin\LyricController@searchLyric'],
                'method' => 'POST',
            ]) !!}
            <div class="col-sm-4 pull-right input-group">
                {!! Form::text ('search', isset($keyword) ? $keyword : null, [
                    'class' => 'form-control',
                    'placeholder' => 'search song name',
                ]) !!}
                <span class="input-group-btn">
                {!! Form::button('<i class="fa fa-search"></i>', [
                    'type' => 'submit',
                    'class' => 'btn btn-default',
                ]) !!}
                </span>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @if (!($lyrics)->total())
        <h4>{{ trans('lyric.no-result') }}</h4>
    @endif
    @foreach($lyrics as $lyric)
        @if (isset($lyric->user_id))
            <div class="member-entry">
                <a href="{{ action('Admin\UserController@show', $lyric->user_id) }}" class="member-img">
                    {{ Html::image(($lyric->user->hasAvatar()) ? config('settings.avatar') . $lyric->user->avatar : config('settings.avatar') . config('settings.avatar_default'),
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
                    <div class="pull-right">
                        <a href="{{ action('Admin\LyricController@show', $lyric->id) }}" class="btn btn-block btn-primary btn-xs">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            {{ trans('lyric.show') }}
                        </a>
                    </div>
                    <div class="row info-list">
                        <div class="col-lg-6"><h4>
                            <span>{{ trans('lyric.song-name') }}</span>
                            <span class="text-primary">{{ $lyric->song->name }}</span>
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
        @endif
    @endforeach
    <div class="col-md-12">{{ $lyrics->links() }}</div>
@endsection
