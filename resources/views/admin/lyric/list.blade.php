@extends('admin.master')

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
    <h2>{{ trans('lyric.update-lyric') }}</h2>
    {!! Form::open([
        'method' => 'POST',
        'action' => ['Admin\LyricController@store'],
        'class' => 'form-horizontal',
    ]) !!}
    <div class="form-group">
        <div class="col-md-7">
            {{ Form::textarea('content', null, [
                'class' => 'form-control',
                'rows' => 3,
                'placeholder' => trans('lyric.enter-content')
            ]) }}
        </div>
    </div>
    {!! Form::hidden('song_id', $song->id) !!}
    <div class="form-group">
        <div class="pull-left">
            {!! Form::button('<i class="fa fa-plus"></i>' . trans('lyric.add-lyric'), [
                'class' => 'btn btn-primary',
                'type' => 'submit',
            ]) !!}
        </div>
    </div>
    {!! Form::close() !!}
    <ul>
        <li><h4>
            {{ trans('song.name')}}
            <span class="text-primary">{{ $song->name }}</span>
        </h4></li>
        <li>{{ trans('song.type-song') . $song->type }}</li>
        @if (isset($currentLyric))
        <li>{{ trans('song.user-suggest') }}
            <span class="text-primary">
                @if (isset($currentLyric->user_id))
                {{ $currentLyric->user->name }}
                @else
                {{ config('settings.admin') }}
                @endif
            </span>
        </li>
        <li>{{ trans('song.lyric') . $currentLyric->content }}</li>
        @else
        <li>{{ trans('song.lyric') . config('settings.null')}}</li>
        @endif
    </ul>
    @foreach ($lyrics as $lyric)
        <div class="col-lg-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><h3>
                            @if (isset($lyric->user_id))
                            <a href="{{ action('Admin\UserController@show', $lyric->user_id) }}">
                                {{ $lyric->user->name }}
                            </a>
                            @else
                            {{ config('settings.admin') }}
                            @endif
                            </span>
                            <span>
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
    @endforeach
    <div class="col-md-12">{{ $lyrics->links() }}</div>
@endsection
