@extends('user.master')

@section('item')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('css/user/music-details.css') !!}
@endsection

@section('content')
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.list-singer') }}</h3>
    </div>
    @foreach ($singers as $singer)
        <div class="col-sm-12">
            <div class="member-entry info">
                <a href="{{ action('User\SingerController@show', $singer['id']) }}" class="member-img">
                    {{ Html::image(($singer->hasAvatar()) ? config('settings.avatar') . $singer->avatar : config('settings.avatar') . config('settings.avatar_default'), trans('singer.this-is-avatar'), [
                            'class' => 'img-rounded',
                    ]) }}
                </a>
                <div class="member-details">
                    <h4>
                        <a href="{{ action('User\SingerController@show', $singer['id']) }}" class="name">{{ $singer->name }}</a>
                    </h4>
                    <div class="row info-list">
                        <div class="col-lg-4"><h5>
                            <span>{{ trans('home.role') }}</span>
                            <span class="text-primary">{{ $singer->getRole() }}</span>
                        </h5></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-12">{{ $singers->links() }}</div>
@endsection
