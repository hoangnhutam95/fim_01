@extends('admin.master')

@section('style')
    {!! Html::style('css/manage-user.css') !!}
@endsection
@section('content')
    <div class="row bootstrap snippets">
        <div class="col-md-9 col-sm-7">
            <h2>{{ trans('user.profile') }}</h2>
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
    <div class="member-entry">
        <a href="{{ action('Admin\UserController@edit', $user->id) }}" class="member-img">
            {{ Html::image(($user->hasAvatar()) ? config('settings.avatar') . $user->avatar : config('settings.avatar') . config('settings.avatar_default'), trans('user.this-is-avatar'), [
                    'class' => 'img-rounded',
            ]) }}
        </a>
        <div class="member-details">
            <h4>
                <a href="{{ action('Admin\UserController@edit', $user->id) }}">{{ $user->name }}</a>
            </h4>
            <div class="row info-list">
                <div class="col-lg-4">
                    <i class="fa fa-envelope"></i>
                    <span class="text-primary">{{ $user->email }}</span>
                </div>
                <div class="col-lg-6">
                    <i class="fa fa fa-phone"></i>
                    <span>{{ trans('user.phone') }}</span>
                    <span class="text-primary">{{ $user->phone ?: config('settings.null') }}</span>
                </div>
                <div class="col-lg-2">
                    <a href="{{ action('Admin\UserController@edit', $user->id) }}"
                    class="btn btn-block btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i>{{ trans('user.edit') }}</a>
                </div>
                <div class="clear"></div>
                <div class="col-lg-4">
                    <span>{{ trans('user.address') }}</span>
                    <span class="text-primary">{{ $user->address ?: config('settings.null') }}</span>
                </div>
                <div class="col-lg-4">
                    <span>{{ trans('user.created-at') }}</span>
                    <span class="text-primary">{{ $user->created_at }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row bootstrap snippets">
        <div class="col-md-9 col-sm-7">
            <h2>{{ trans('user.list-favorite-of-user') }}</h2>
        </div>
    </div>
    @foreach ($user->favorites as $favorite)
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $favorite->id }}" class=text-primary>
                        {{ $favorite->name }}
                        </a>
                    </h4>
                </div>
                <div id="collapse{{ $favorite->id }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('user.song-name')}}</th>
                                    <th>{{ trans('user.singer-name')}}</th>
                                    <th>{{ trans('user.add-at')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favorite->favoriteDetails as $favoriteDetail)
                                <tr>
                                    <td><a href="">{{ $favoriteDetail->song->name }}</a></td>
                                    <td>{{ $favoriteDetail->song->singer->name ?: trans('user.unknow') }}</td>
                                    <td>{{ $favoriteDetail->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    @endforeach
@endsection
