@extends('layouts.app')

@section('title')
    {{ trans('auth.login') }}
@endsection

@section('content')
<div class="container">
    @if (Session::has('flash_message'))
        <div class="alert alert-success">
            {!! Session::get('flash_message') !!}
        </div>
    @endif
    <div class="row">
        <div class="modal-2">
            <div class="omb_login">
                <h3 class="omb_authTitle">Login or <a href="{{ route('register') }}">{{ trans('auth.signup') }}</a></h3>
                <div class="row omb_row-sm-offset-3 omb_socialButtons">
                    <div class="col-xs-4 col-sm-3">
                    <a href="redirect/facebook" class="btn btn-lg btn-block omb_btn-facebook">
                            <i class="fa fa-facebook visible-xs"></i>
                            <span class="hidden-xs">Facebook</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-3">
                        <a href="redirect/google" class="btn btn-lg btn-block omb_btn-google">
                            <i class="fa fa-google-plus visible-xs"></i>
                            <span class="hidden-xs">Google+</span>
                        </a>
                    </div>
                </div>

                <div class="row omb_row-sm-offset-3 omb_loginOr">
                    <div class="col-xs-12 col-sm-6">
                        <hr class="omb_hrOr">
                        <span class="omb_spanOr">or</span>
                    </div>
                </div>

                <div class="row omb_row-sm-offset-3">
                    <div class="col-xs-12 col-sm-6">
                        {{ Form::open([
                            'method' => 'POST',
                            'class' => 'omb_loginForm',
                            'action' => 'Auth\LoginController@login',
                            'role' => 'form',
                        ]) }}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <span class="erra help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <span class="help-block"></span>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                            @if ($errors->has('password'))
                                <span class="erra help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <span class="help-block"></span>
                            {{ Form::submit(trans('auth.login'), ['class' => 'btn btn-lg btn-primary btn-block']) }}
                        {{ Form::close() }}
                    </div>
                </div>
                {{ Form::open() }}
                <div class="row omb_row-sm-offset-3">
                    <div class="col-xs-12 col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="text">{{ trans('auth.remember_me') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
