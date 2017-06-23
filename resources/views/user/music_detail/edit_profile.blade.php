@extends('user.master')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('home.edit-profile') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'POST',
                        'action' => ['User\UserController@update'],
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">
                            {{ trans('user.full-name') }}
                        </label>
                        <div class="col-md-7">
                            {!! Form::text ('name', old('name',
                                Auth::user()->name), [
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
                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-4 control-label">
                            {{ trans('user.address') }}
                        </label>
                        <div class="col-md-7">
                            {!! Form::text ('address', old('address',
                                Auth::user()->address), [
                                'class' => 'form-control',
                                'id' => 'address',
                            ]) !!}

                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                     <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-4 control-label">
                            {{ trans('user.phone') }}
                        </label>
                        <div class="col-md-7">
                            {!! Form::text ('phone', old('phone',
                                Auth::user()->phone), [
                                'class' => 'form-control',
                                'id' => 'phone',
                            ]) !!}

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                        <label for="avatar" class="col-md-4 control-label">{{ trans('user.avatar') }}</label>
                        <div class="col-md-7">
                            {!! Form::file('avatar', [
                                'class' => 'form-control',
                            ]) !!}

                            @if ($errors->has('avatar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                            {{ Form::hidden('current_img', Auth::user()->avatar) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-4">
                            {!! Form::button(trans('user.update'), [
                                'class' => 'btn btn-primary',
                                'type' => 'submit',
                            ]) !!}
                            {!! Form::button(trans('user.reset'), [
                                'class' => 'btn btn-default',
                                'type' => 'reset',
                            ]) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
