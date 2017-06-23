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
    <div class="col-md-7">
        <h4>{{ trans('hot.list-audio-hot') }}</h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>{{ trans('album.song-name') }}</th>
                <th>{{ trans('hot.rate-point') }}</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video )
                    <tr>
                        <td><a href="{{ action('Admin\VideoController@show', $video['id']) }}">{{ $video->name }}</a><br>
                            <span class="text-muted small">{{ $video->singer_id ? $video->singer->name : config('settings.null')}}</span>
                        </td>
                        <td><span class="rate-pont">{{ $video->rate_point }}</span><span>( {{ $video->rate_number }}{{ trans('hot.voted') }} )</span></td>
                        <td><div class="pull-right">
                            {!! Form::open([
                                'action' => ['Admin\HotController@setNotHot', $video['id']],
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
        <h4>{{ trans('hot.search-song-pin-hot') }}</h4>
        <div>
            {!! Form::open([
                'action' => ['Admin\HotController@searchNotHotVideo'],
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
                        <th>{{ trans('hot.rate-point') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($songs as $song )
                    <tr>
                        <td><a href="{{ action('Admin\VideoController@show', $song['id']) }}">{{ $song->name }}</a></td>
                        <td><span class="rate-pont text-center">{{ $song->rate_point }}</span><span>({{ $song->rate_number }})</span></td>
                        <td><div class="pull-right">
                            {!! Form::open([
                                'action' => ['Admin\HotController@setHot', $song['id']],
                                'method' => 'POST',
                            ]) !!}
                            {!! Form::button(trans('hot.pin-hot'), [
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
