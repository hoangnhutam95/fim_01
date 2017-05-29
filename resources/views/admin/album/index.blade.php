
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
    <div class="admin-album">
        <div class="sidebar-search">
            {!! Form::open([
                'action' => ['Admin\AlbumController@searchAlbum'],
                'method' => 'POST',
            ]) !!}
                <div class="col-sm-4 pull-right input-group">
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
        </div>
        <h2>{{ trans('album.list-album') }}</h2>
        <a class="btn btn-primary pull-right" href="{{ action('Admin\AlbumController@create') }}">
            <i class="fa fa-plus"></i>{{ trans('album.add-album') }}
        </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>{{ trans('album.album-name') }}</th>
                <th>{{ trans('album.category') }}</th>
                <th>{{ trans('album.rate_point') }}</th>
                <th>{{ trans('album.rate_number') }}</th>
                <th>{{ trans('album.comment_number') }}</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                @if (!($albums)->total())
                    <h4>{{ trans('album.no-result') }}</h4>
                @endif
                @foreach ($albums as $album )
                    <tr>
                        <td><a href="{{ action('Admin\AlbumController@show', $album->id) }}">{{ $album->name }}</a></td>
                        <td>{{ ($album->category) ? $album->category->name : config('settings.null') }}</td>
                        <td>{{ $album->rate_point }}</td>
                        <td>{{ $album->rate_number }}</td>
                        <td>{{ $album->comment_number }}</td>
                        <td>
                             <div><a href="{{ action('Admin\AlbumController@show', $album->id) }}" class="btn btn-block btn-success btn-xs">
                                <i class="glyphicon glyphicon-plus-sign">{{ trans('album.show') }}</i>
                            </a></div>
                        </td>
                        <td>
                            <div><a href="{{ action('Admin\AlbumController@edit', $album->id) }}" class="btn btn-block btn-primary btn-xs">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a></div>
                        </td>
                        <td><div>
                            {!! Form::open([
                                'action' => ['Admin\AlbumController@destroy', $album['id']],
                                'method' => 'delete',
                                'class' => 'fix-form',
                            ]) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                                'class' => 'btn btn-block btn-danger btn-xs delete-button',
                                'type' => 'submit',
                            ]) !!}
                            {{ Form::close() }}
                        </dix></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">{{ $albums->links() }}</div>
@endsection
