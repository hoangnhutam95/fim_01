@extends('admin.master')

@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{ trans('admin.category') }}
        <small>{{ trans('admin.add') }}</small>
    </h1>
</div>
<div class="col-lg-7 form-item">
    {!! Form::open([
        'method' => 'POST',
        'enctype' => 'multipart/form-data',
        'action' => ['Admin\CategoryController@store'],
    ]) !!}
        <div class="form-group">
            <label>{{ trans('admin.name') }}</label>
            {!! Form::text ('name', old('name'), [
                'class' => 'form-control',
                'placeholder' => trans('admin.enter-name'),
            ]) !!}
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="type" class="col-md-4 control-label">
                {{ trans('admin.type') }}
            </label>
            {!! Form::select('type', config('settings.category'), null, [
            'class' => 'form-control',
            ]) !!}
        </div>
        <div class="col-md-6">
            {!! Form::file('cover', [
                'class' => 'form-control',
                'id' => 'images',
                'onchange' => 'preview_images()',
            ]) !!}
        </div>
            {!! Form::button(trans('admin.add-category'), [
                'class' => 'btn btn-default',
                'type' => 'submit',
            ]) !!}
            {!! Form::button(trans('admin.reset'), [
                'class' => 'btn btn-default',
                'type' => 'reset',
            ]) !!}
    {!! Form::close() !!}
    <div class="row" id="image_preview"></div>
@endsection()
