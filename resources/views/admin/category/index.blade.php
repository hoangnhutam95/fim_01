@extends('admin.master')

@section('content')
    <div class="col-lg-10">
        <div class="row" id="content">
            <div class="col-lg-10 col-lg-offset-1 panel panel-primary">
                <div class="panel-heading">
                    <h2>{{ trans('admin.list') }}</h2>
                </div>
                <div class="panel-body">
                    <a class="btn btn-primary pull-left" href="{{ action('Admin\CategoryController@create') }}">
                        <i class="fa fa-plus"></i> {{ trans('admin.add') }}
                    </a>
                    <div class="panel-body">
                        <div class="box box-primary">
                            <div class="box-body">
                                <table class="table table-responsive" id="users-table">
                                    <thead>
                                        <th>{{ trans('admin.stt') }}</th>
                                        <th>{{ trans('admin.name') }}</th>
                                        <th>{{ trans('admin.image') }}</th>
                                        <th>{{ trans('admin.type') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category['name'] }}</td>
                                            <td>
                                                {{ Html::image(($category->hasCoverCategory()) ? config('settings.cover_category_path') . $category->cover : config('settings.cover_category_path') . config('settings.cover_default'),
                                                    null,
                                                    [
                                                        'class' => 'img_item',
                                                ]) }}
                                            </td>
                                            <td>{{ $category->type }}</td>
                                            <td><a href="{{ action('Admin\CategoryController@edit', $category['id']) }}"
                                            class="btn btn-block btn-primary btn-xs">{{ trans('admin.edit') }}</a>
                                            </td>
                                            <td>
                                            {!! Form::open([
                                                'class' => 'fixform',
                                                'method' => 'delete',
                                                'action' => ['Admin\CategoryController@destroy', $category['id']],
                                                ])
                                            !!}
                                            {!! Form::button(trans('admin.delete'), [
                                                'class' => 'btn btn-block btn-danger btn-xs delete-button',
                                                'type' => 'submit',
                                                ])
                                            !!}
                                            {{ Form::close() }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">{{ $categories->links() }}</div>
@endsection
