@extends('admin.master')

@section('style')
    {!! Html::style('css/manage-user.css') !!}
@endsection
@section('content')
    <div class="row bootstrap snippets">
        <div class="col-md-9 col-sm-7">
            <h2>{{ trans('user.list-user') }}</h2>
        </div>
    </div>
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
    @foreach($users as $user)
        <div class="member-entry">
            <a href="{{ action('Admin\UserController@edit', $user->id) }}" class="member-img">
                {{ Html::image(($user->hasAvatar()) ? config('settings.avatar') . $user->avatar : $user->avatar,
                    trans('user.this-is-avatar'), [
                        'class' => 'img-rounded',
                ]) }}
            </a>
            <div class="member-details">
                <h4><a href="{{ action('Admin\UserController@edit', $user->id) }}">{{ $user->name }}
                    {{ $user->role == 1 ? trans('user.admin') : trans('user.user') }}
                </a></h4>
                <div class="row info-list">
                    <div class="col-lg-4">
                        <i class="fa fa-envelope"></i>
                        <span class="text-primary">{{ $user->email }}</span>
                    </div>
                    <div class="col-lg-6">
                        <span>{{ trans('user.created-at') }}</span>
                        <span class="text-primary">{{ ($user->created_at != null) ? $user->created_at->diffForHumans() : NULL }}</span>
                    <div class="col-lg-2">
                        <a href="{{ action('Admin\UserController@show', $user->id) }}" class="btn btn-block btn-primary btn-xs">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            {{ trans('user.show-profile') }}
                        </a>
                    </div>
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2">
                        {!! Form::open([
                            'action' => ['Admin\UserController@destroy', $user['id']],
                            'method' => 'delete',
                            ])
                        !!}
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>' . trans('user.delete'), [
                            'class' => 'btn btn-block btn-danger btn-xs delete-button',
                            'type' => 'submit',
                            ])
                        !!}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-12">{{ $users->links() }}</div>
@endsection
