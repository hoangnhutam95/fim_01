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
                <th>{{ trans('hot.view-count-week') }}</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($audios as $audio )
                    <tr>
                        <td><a href="{{ action('Admin\AudioController@show', $audio['id']) }}">{{ $audio->name }}</a><br>
                            <span class="text-muted small">{{ $audio->singer_id ? $audio->singer->name : config('settings.null')}}</span>
                        </td>
                        <td><span class="rate-point">{{ $audio->rate_point }}</span><span>( {{ $audio->rate_number }}{{ trans('hot.voted') }} )</span></td>
                        <td><span class="rate-point">{{ ($audio->view)? $audio->view->view_count_all : config('settings.zero') }}</span></td>
                        <td><div class="pull-right">
                            {!! Form::open([
                                'action' => ['Admin\HotController@setNotHot', $audio['id']],
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
                'action' => ['Admin\HotController@searchNotHotAudio'],
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
                        <td><a href="{{ action('Admin\AudioController@show', $song['id']) }}">{{ $song->name }}</a></td>
                        <td><span class="rate-point text-center">{{ $song->rate_point }}</span><span>({{ $song->rate_number }})</span></td>
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
                </tbody>
            </table>
            @endif
            @if (isset($views))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('album.song-name') }}</th>
                        <th>{{ trans('hot.view-count-week') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($views as $view )
                    <tr>
                        <td><a href="{{ action('Admin\AudioController@show', $view->song->id) }}">{{ $view->song->name }}</a></td>
                        <td><span class="rate-pont text-center">{{ $view->view_count_week }}</span></td>
                        <td><div class="pull-right">
                            {!! Form::open([
                                'action' => ['Admin\HotController@setHot', $view->song->id],
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
                        <td>
                            @if ($views->count() <= $songs->count())
                                {{ $songs->links() }}
                            @else
                                {{ $views->links() }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
