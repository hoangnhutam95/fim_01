@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('singer.edit-singer') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'PATCH',
                        'action' => ['Admin\SingerController@update', $singer['id']],
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">
                                {{ trans('singer.name') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::text ('name', old('name',
                                    isset($singer) ? $singer['name'] : null), [
                                    'class' => 'form-control',
                                    'id' => 'name',
                                ]) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">
                                {{ trans('singer.role') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::select('role', array(
                                    '1' => config('settings.singer.solo'),
                                    '2' => config('settings.singer.duet'),
                                    '3' => config('settings.singer.group'),
                                    '4' => config('settings.singer.other'),
                                    ), $singer['id'], [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="avatar" class="col-md-4 control-label">{{ trans('singer.avatar_image') }}</label>
                            <div class="col-md-7">
                                {!! Form::file('avatar', [
                                    'class' => 'form-control',
                                ]) !!}

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                                @if (isset($singer))
                                {{ Form::hidden('current_img', $singer['avatar']) }}
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                {!! Form::button(trans('singer.edit-singer'), [
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
