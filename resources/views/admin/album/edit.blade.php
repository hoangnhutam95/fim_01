@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('album.edit-album') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'PATCH',
                        'action' => ['Admin\AlbumController@update', $album['id']],
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">
                                {{ trans('album.name') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::text ('name', old('name',
                                    isset($album) ? $album['name'] : null), [
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
                            <label for="category_id" class="col-md-4 control-label">
                                {{ trans('album.category') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::select('category_id', $categories, $album['category_id'], [
                                'class' => 'form-control',
                                ]) !!}
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
                                @if (isset($album))
                                    {{ Form::hidden('current_img', $album['cover']) }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                {!! Form::button(trans('album.update'), [
                                    'class' => 'btn btn-primary',
                                    'type' => 'submit',
                                ]) !!}
                                {!! Form::button(trans('album.reset'), [
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
