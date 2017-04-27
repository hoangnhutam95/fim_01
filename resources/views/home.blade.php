@extends('layouts.app')

@section('title')
    {{ trans('auth.homepage') }}
@endsection

@section('content')
<div class="container">
    @if (Session::has('flash_message'))
        <div class="alert alert-success">
            {!! Session::get('flash_message') !!}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.imusic') }}</div>

                <div class="panel-body">
                    {{ trans('auth.logged') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
