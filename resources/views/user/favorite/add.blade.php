@extends('user.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('home.create-playlist') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'POST',
                        'action' => ['User\FavoriteController@store'],
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">
                                {{ trans('home.playlist-name') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::text ('name', old('name'), [
                                    'class' => 'form-control',
                                    'id' => 'name',
                                    'placeholder' => trans('album.enter-name'),
                                ]) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
                            <label for="cover" class="col-md-4 control-label">{{ trans('album.cover_image') }}</label>
                            <div class="col-md-7">
                                {!! Form::file('cover', [
                                    'class' => 'form-control',
                                ]) !!}

                                @if ($errors->has('cover'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cover') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                {!! Form::button(trans('home.add-playlist'), [
                                    'class' => 'btn btn-primary',
                                    'type' => 'submit',
                                ]) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
