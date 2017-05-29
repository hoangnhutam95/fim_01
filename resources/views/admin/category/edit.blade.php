@extends('admin.master')

@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{ trans('admin.category') }}
        <small>{{ trans('admin.edit') }}</small>
    </h1>
</div>
<div class="col-lg-7 form-item">
    {!! Form::open([
        'method' => 'PUT',
        'enctype' => 'multipart/form-data',
        'action' => [
            'Admin\CategoryController@update',
            $category['id'],
            ],
        ]) !!}
    @if (isset($category))
        {{ Form::hidden('id', $category['id']) }}
    @endif
        <div class="form-group">
            <label>{{ trans('admin.name') }}</label>
            {!! Form::text ('name', old('name', $category['name']), [
                'class' => 'form-control',
                'placeholder' => trans('admin.enter-name'),
            ]) !!}
        </div>
        <div class="form-group">
            <label for="type" class="col-md-4 control-label">
                {{ trans('admin.type') }}
            </label>
            {!! Form::select('type', config('settings.category'), $category['type'], [
            'class' => 'form-control',
            ]) !!}
        </div>
        <div class="col-md-6">
            {!! Form::file('cover', [
                'class' => 'form-control',
                'id' => 'images',
                'onchange' => 'preview_images()',
            ]) !!}
            @if (isset($category))
                {{ Form::hidden('current_img', $category['cover']) }}
            @endif
        </div>
            {!! Form::button(trans('admin.update-category'), [
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
