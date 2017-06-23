@extends('admin.master')

@section('content')
    @if (Session::has('errors'))
        <div class="alert alert-danger">
            {{ Session::get('errors') }}
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="admin-singer">
        <div class="sidebar-search">
            {!! Form::open([
                'action' => ['Admin\SingerController@searchSinger'],
                'method' => 'POST',
            ]) !!}
                <div class="col-sm-4 pull-right input-group">
                    {!! Form::text ('search', isset($input) ? $input : null, [
                        'class' => 'form-control',
                        'placeholder' => 'search',
                    ]) !!}
                    <span class="input-group-btn">
                    {!! Form::button('<i class="fa fa-search"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-default',
                    ]) !!}
                    </span>
                </div>
            {!! Form::close() !!}
        </div>
        <h2>{{ trans('singer.singer') }}</h2>
        <a class="btn btn-primary pull-right" href="{{ action('Admin\SingerController@create') }}">
            <i class="fa fa-plus"></i>{{ trans('singer.add-singer') }}
        </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>{{ trans('singer.singer-name') }}</th>
                <th>{{ trans('singer.role') }}</th>
                <th>{{ trans('singer.created-at') }}</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            @if (!($singers)->total())
            <h4>{{ trans('singer.no-result') }}</h4>
            @endif
            @foreach ($singers as $singer )
                <tr>
                    <td><a href="{{ action('Admin\SingerController@show', $singer->id) }}">{{ $singer->name }}</a></td>
                    <td>{{ $singer->getRole() }}</td>
                    <td>{{ $singer->created_at->diffForHumans() }}</td>
                    <td>
                        <div class="singer-bnt"><a href="{{ action('Admin\SingerController@edit', $singer->id) }}" class="btn btn-block btn-primary btn-xs">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a></div>
                    </td>
                    <td><div class="singer-bnt">
                        {!! Form::open([
                            'action' => ['Admin\SingerController@destroy', $singer['id']],
                            'method' => 'delete',
                            'class' => 'fix-form',
                        ]) !!}
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                            'class' => 'btn btn-block btn-danger btn-xs delete-button',
                            'type' => 'submit',
                        ]) !!}
                        {{ Form::close() }}
                    </dix></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-md-12">{{ $singers->links() }}</div>
@endsection
