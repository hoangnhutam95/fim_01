@extends('user.master')

@section('item')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('bower_components/plyr/dist/plyr.css') !!}
    {!! Html::style('css/video-media.css') !!}
    {!! Html::style('css/user/music-details.css') !!}
@endsection
@section('script')
    {!! Html::script('bower_components/plyr/dist/plyr.js') !!}
    {!! Html::script('js/media.js') !!}
    {!! Html::script('js/show-more.js') !!}
@endsection

@section('content')
    <div class="member-entry info">
        <a href="{{ $video->singer_id ? action('User\SingerController@show', $video->singer_id) : null }}" class="member-img">
            @if (isset($video->singer))
            {{ Html::image(($video->singer->hasAvatar()) ? config('settings.avatar') . $video->singer->avatar : config('settings.avatar') . config('settings.avatar_default'), trans('singer.this-is-avatar'), [
                    'class' => 'img-rounded',
            ]) }}
            @else
            {{ Html::image(config('settings.avatar') . config('settings.avatar_default'), trans('singer.this-is-avatar'), [
                    'class' => 'img-rounded',
            ]) }}
            @endif
        </a>
        <div class="member-details">
            <h4>
                <a href="" class="name">{{ $video->name }}</a>
                <span> - </span>
                <a href="{{ $video->singer_id ? action('User\SingerController@show', $video->singer_id) : null }}">{{ $video->singer_id ? $video->singer->name : config('settings.null') }}</a>
            </h4>
            <div class="row info-list">
                <div class="col-lg-4"><h5>
                    <span>{{ trans('home.musician') }}</span>
                    <span class="text-primary">{{ ($video->author) ? $video->author : config('settings.null') }}</span>
                </h5></div>
                <div class="col-lg-4"><h5>
                    <span>{{ trans('home.topic') }}</span>
                    <span class="text-primary">
                        <a href="{{ $video->category_id ? action('User\HomeController@showVideoOfTopic', $video->category_id) : null }}">
                            {{ ($video->category) ? $video->category->name : config('settings.null') }}
                        </a>
                    </span>
                </h5></div>
                <div class="col-lg-4" id="rate-point"><h5>
                    <span>{{ trans('home.rate-point') }}</span>
                    <span class="text-primary rate-point">{{ $video->rate_point }}</span>
                    <span class="text-primary">({{ $video->rate_number }} {{ trans('home.voted') }})</span>
                </h5></div>
                <div class="col-lg-12">
                    <h5><span>{{ trans('song.description') }}</span>
                    <span class="text-success more">{{ ($video->description) ?: config('settings.null') }}</span></h5>
                </div>
                @if (auth()->check())
                    <div class="col-lg-12">
                        <h4 class="text-primary">{{ trans('home.rate-it') }}</h4>
                        {!! Form::open() !!}
                            <div class="hide-rate" data-route="{{ url('rate-song') }}"></div>
                            {!! Form::text('rate', $ratePoint, [
                                'id' => "input-2",
                                'class' => 'rating rating-loading',
                                'data-size' => "xs",
                                'data-step' => "1",
                            ]) !!}
                            {!! Form::hidden('target_id', $video->id, [
                                'id' => 'target_id',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id, [
                                'id' => 'user_id',
                            ]) !!}
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="video-cover">
        <div class="plyr-1" song-id="{{ $video->id }}">
            <video poster="{{ ($video->hasCoverVideo()) ? config('settings.video_cover_path') . $video->cover : config('settings.video_cover_path') . config('settings.cover_default') }}" controls id='song-view'>
            <source src="{{ config('settings.video_path') . $video->link }}" type="video/mp4">
            </video>
        </div>
    </div>

    @include('user.music_detail.lyric')

    @include('user.music_detail.suggest_music')

    @include('user.music_detail.comment')

@endsection
