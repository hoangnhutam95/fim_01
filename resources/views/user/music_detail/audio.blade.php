@extends('user.master')

@section('item')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('bower_components/plyr/dist/plyr.css') !!}
    {!! Html::style('css/audio-media.css') !!}
    {!! Html::style('css/user/music-details.css') !!}
@endsection
@section('script')
    {!! Html::script('bower_components/plyr/dist/plyr.js') !!}
    {!! Html::script('js/media.js') !!}
    {!! Html::script('js/show-more.js') !!}
@endsection

@section('content')
    <div class="member-entry info">
        <a href="" class="member-img">
            @if (isset($audio->singer_id))
            {{ Html::image(($audio->singer->hasAvatar()) ? config('settings.avatar') . $audio->singer->avatar : config('settings.avatar') . config('settings.avatar_default'), trans('singer.this-is-avatar'), [
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
                <a href="" class="name">{{ $audio->name }}</a>
                <span> - </span>
                <a href="">{{ $audio->singer_id ? $audio->singer->name : config('settings.null') }}</a>
            </h4>
            <div class="row info-list">
                <div class="col-lg-4"><h5>
                    <span>{{ trans('home.musician') }}</span>
                    <span class="text-primary">{{ ($audio->author) ? $audio->author : config('settings.null') }}</span>
                </h5></div>
                <div class="col-lg-4"><h5>
                    <span>{{ trans('home.topic') }}</span>
                    <span class="text-primary">{{ ($audio->category) ? $audio->category->name : config('settings.null') }}</span>
                </h5></div>
                <div class="col-lg-4" id="rate-point"><h5>
                    <span>{{ trans('home.rate-point') }}</span>
                    <span class="text-primary rate-point">{{ $audio->rate_point }}</span>
                    <span class="text-primary">({{ $audio->rate_number }} {{ trans('home.voted') }})</span>
                </h5></div>
                <div class="col-lg-12">
                    <h5><span>{{ trans('song.description') }}</span>
                    <span class="text-success more">{{ ($audio->description) ?: config('settings.null') }}</span></h5>
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
                            {!! Form::hidden('target_id', $audio->id, [
                                'id' => 'target_id',
                            ]) !!}
                            {!! Form::hidden('user_id', Auth::user()->id, [
                                'id' => 'user_id',
                            ]) !!}
                        {!! Form::close() !!}
                    </div>
                @else
                    <div class="col-lg-12">
                        <
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="audio-cover" backgr={{ ($audio->hasCoverAudio()) ? config('settings.audio_cover_path') . $audio->cover : config('settings.audio_cover_path') . config('settings.cover_default') }}>
        <div class="admin-audio-name"></div>
        <audio controls preload loop>
            <source src="{{ config('settings.audio_path') . $audio->link }}" type="audio/mpeg">
            {{ trans('song.brower_not_support') }}
        </audio>
    </div>

    @include('user.music_detail.lyric')

    @include('user.music_detail.suggest_music')

    @include('user.music_detail.comment')

@endsection
