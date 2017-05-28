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
    <h4>{{ trans('album.album') }}<span class="text-primary">{{ $album->name }}</span></h4>
    <div class="col-md-7">
        <h4>{{ trans('album.list-song-of-album') }}</h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>{{ trans('album.song-name') }}</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($album->albumDetails as $albumDetail )
                    <tr>
                        <td><a href="{{ action('Admin\AudioController@show', $albumDetail->song_id) }}">{{ $albumDetail->song->name }}</a></td>
                        <td><div class="pull-right">
                            {!! Form::open([
                                'action' => ['Admin\AlbumController@removeSong', $albumDetail['id']],
                                'method' => 'delete',
                                'class' => 'fixform',
                            ]) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>' . trans('album.out'), [
                                'class' => 'btn btn-block btn-danger btn-xs delete-button',
                                'type' => 'submit',
                            ]) !!}
                            {{ Form::close() }}
                        </div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-5 search-song-album">
        <h4>{{ trans('album.search-song-import') }}</h4>
        <div>
            {!! Form::open([
                'action' => ['Admin\AlbumController@searchSong', $album['id']],
                'method' => 'POST',
            ]) !!}
                <div class="input-group custom-search-form">
                    {!! Form::text ('search', isset($input) ? $input : null, [
                        'class' => 'form-control',
                        'placeholder' => trans('album.search'),
                    ]) !!}
                    <span class="input-group-btn">
                    {!! Form::button('<i class="fa fa-search"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-default',
                    ]) !!}
                    </span>
                </div>
            {!! Form::close() !!}
            @if (isset($songs))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('album.song-name') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($songs as $song )
                    <tr>
                        <td><a href="{{ action('Admin\AudioController@show', $song['id']) }}">{{ $song->name }}</a></td>
                        <td><div class="pull-right">
                            {!! Form::open([
                                'action' => ['Admin\AlbumController@createAlbumDetail', $album->id],
                                'method' => 'PUT',
                            ]) !!}
                            {!! Form::hidden('song_id', $song['id']) !!}
                            {!! Form::button(trans('album.import'), [
                                'class' => 'btn btn-block btn-success btn-xs',
                                'type' => 'submit',
                            ]) !!}
                            {{ Form::close() }}
                        </div></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>{{ $songs->links() }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
