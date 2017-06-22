@extends('user.master')

@section('item')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('css/user/music-details.css') !!}
@endsection

@section('content')
    <div class="member-entry info">
        <a href="" class="member-img">
            {{ Html::image((Auth::user()->hasAvatar()) ? config('settings.avatar') . Auth::user()->avatar : config('settings.avatar') . config('settings.avatar_default'), trans('singer.this-is-avatar'), [
                    'class' => 'img-rounded',
            ]) }}
        </a>
        <div class="member-details">
            <h4>
                <a href="" class="name">{{ Auth::user()->name }}</a>
            </h4>
            <div class="pull-right">
                <a href="{{ action('User\UserController@edit') }}" class="btn btn-block btn-primary btn-xs">
                    <i class="glyphicon glyphicon-edit">{{ trans('song.edit') }}</i>
                </a>
            </div>
            <div class="row info-list">
                <div class="col-lg-4"><h5>
                    <span>{{ trans('user.phone') }}</span>
                    <span class="text-primary">{{ Auth::user()->phone ?: config('settings.null') }}</span>
                </h5></div>
                <div class="col-lg-4"><h5>
                    <span>{{ trans('user.address') }}</span>
                    <span class="text-primary">{{ Auth::user()->address ?: config('settings.null') }}</span>
                </h5></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.my-playlist') }}</h3>
    </div>
    @if (!Auth::user()->favorites->count())
        <h2>{{ trans('home.no-playlist')}}</h2>
    @endif
    @foreach (Auth::user()->favorites as $favorite)
    <div class="col-sm-3 list">
        <a href="" title="{{ $favorite->name }}">
            <img src="{{ ($favorite->hasCoverFavorite()) ? config('settings.favorite_cover_path') . $album->cover : config('settings.favorite_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="" title="{{ $favorite->name }}">
            <div class="music-name">{{ $favorite->name }}</div>
        </a>
        <div class="">
            <div class="singer-name text-muted">{{ $favorite->favoriteDetails->count() }}</div>
        </a>
    </div>
    @endforeach
@endsection
