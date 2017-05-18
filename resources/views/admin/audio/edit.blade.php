@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('song.edit-audio') }}</div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'PATCH',
                        'action' => ['Admin\AudioController@update', $audio['id']],
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                        @if (isset($audio))
                            {{ Form::hidden('id', $audio['id']) }}
                        @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">
                                {{ trans('song.name') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::text ('name', old('name',
                                    isset($audio) ? $audio['name'] : null), [
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
                            <label for="author" class="col-md-4 control-label">
                                {{ trans('song.composed') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::text ('author', old('author',
                                    isset($audio) ? $audio['author'] : null), [
                                    'class' => 'form-control',
                                    'id' => 'author',
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="col-md-4 control-label">
                                {{ trans('song.category') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::select('category_id', $categories, $audio['category_id'], [
                                'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="singer_id" class="col-md-4 control-label">
                                {{ trans('song.singer') }}
                            </label>
                            <div class="col-md-7">
                                {!! Form::select('singer_id', $singers, $audio['singer_id'], [
                                'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
                            <label for="cover" class="col-md-4 control-label">{{ trans('song.cover_image') }}</label>
                            <div class="col-md-7">
                                {!! Form::file('cover', [
                                    'class' => 'form-control',
                                ]) !!}

                                @if ($errors->has('cover'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cover') }}</strong>
                                    </span>
                                @endif
                                @if (isset($audio))
                                    {{ Form::hidden('current_img', $audio['cover']) }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">{{ trans('song.file_audio') }}</label>
                            <div class="col-md-7">
                                {!! Form::file('link', [
                                    'class' => 'form-control',
                                ]) !!}

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                                @if (isset($audio))
                                    {{ Form::hidden('current_file', $audio['link']) }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                {!! Form::button(trans('song.update'), [
                                    'class' => 'btn btn-primary',
                                    'type' => 'submit',
                                ]) !!}
                                {!! Form::button(trans('song.reset'), [
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
