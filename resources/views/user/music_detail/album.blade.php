@extends('user.master')

@section('item')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('bower_components/plyr/dist/plyr.css') !!}
    {!! Html::style('css/audio-media.css') !!}
    {!! Html::style('css/user/music-details.css') !!}
@endsection
@section('script')
    {!! Html::script('bower_components/plyr/dist/plyr.js') !!}
    {!! Html::script('js/playlist.js') !!}
    {!! Html::script('js/show-more.js') !!}
    {!! Html::script('js/view-count.js') !!}
@endsection

@section('content')
    <div class="member-entry info">
        <a href="" class="member-img">
            {{ Html::image(($album->hasCoverAlbum()) ? config('settings.album_cover_path') . $album->cover : config('settings.album_cover_path') . config('settings.cover_default'), trans('singer.this-is-avatar'), [
                    'class' => 'img-rounded',
            ]) }}
        </a>
        <div class="member-details">
            <h4>
                <a href="" class="name"><span class="text-primary">{{ trans('home.album-1') }}</span>{{ $album->name }}</a>
            </h4>
            <div class="row info-list">
                <div class="col-lg-4"><h5>
                    <span>{{ trans('home.topic') }}</span>
                    <a href="{{ $album->category_id ? action('User\HomeController@showAlbumOfTopic', $album->category_id) : null }}">
                            {{ ($album->category) ? $album->category->name : config('settings.null') }}
                        </a>
                </h5></div>
                <div class="col-lg-4" id="rate-point"><h5>
                    <span>{{ trans('home.rate-point') }}</span>
                    <span class="text-primary rate-point">{{ $album->rate_point }}</span>
                    <span class="text-primary">({{ $album->rate_number }} {{ trans('home.voted') }})</span>
                </h5></div>
                @if (auth()->check())
                    <div class="col-lg-12">
                        <h4 class="text-primary">{{ trans('home.rate-it') }}</h4>
                        {!! Form::open() !!}
                            <div class="hide-rate" data-route="{{ url('rate-album') }}"></div>
                            {!! Form::text('rate', $ratePoint, [
                                'id' => "input-2",
                                'class' => 'rating rating-loading',
                                'data-size' => "xs",
                                'data-step' => "1",
                            ]) !!}
                            {!! Form::hidden('target_id', $album->id, [
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
    @php ($i = 0)
    @php ($k = 0)
    <div class="audio-cover" backgr={{ ($audios[0]->hasCoverAudio()) ? config('settings.audio_cover_path') . $audios[0]->cover : config('settings.audio_cover_path') . config('settings.cover_default') }}>
        <div class="admin-audio-name">
            {{ trans('song.song') }}
            <span id="audio-name-color">{{ $audios[0]->name }}</span>
        </div>
        <div class="plyr-1">
            <audio controls class="test-p" id='audio-view'>
                <source src="{{ config('settings.audio_path') . $audios[0]->link }}" type="audio/mpeg">
                {{ trans('song.brower_not_support') }}
            </audio>
        </div>
    </div>
    @foreach ($audios as $key => $audio )
        @php ($k++)
        {!! Form::open() !!}
            {!! Form::hidden('audio_id', $audio->id, [
                'id' => 'audio-id' . $key,
            ]) !!}
            {!! Form::hidden('src', ($audio->hasFileAudio()) ? config('settings.audio_path') . $audio->link : $audio->link, [
                'id' => 'link-audio' . $key,
            ]) !!}
            {!! Form::hidden('cover-audio', ($audio->hasCoverAudio()) ? config('settings.audio_cover_path') . $audio->cover : config('settings.audio_cover_path') . config('settings.cover_default'), [
                'id' => 'cover-audio' . $key,
            ]) !!}
            {!! Form::hidden('audio-name', $audio->name, [
                'id' => 'audio-name' . $key,
            ]) !!}
        {!! Form::close() !!}
    @endforeach
    <div id='current-audio' data-key="{{ $i }}" data-max-key="{{ $k }}"></div>
    <div class="col-md-12">
        <table class="table table-hover list-album">
            <thead>
                <tr>
                    <th>{{ trans('album.song-name') }}</th>
                    <th>{{ trans('home.singer-name') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($audios as $key => $audio )
                    <tr>
                        @if ($audio == $audios[0])
                        <td><a href="{{ action('User\MusicController@showAudio', $audio['id']) }}" class="play-audio album-active" key="{{ $key }}" id="album-detail{{ $key }}">{{ $audio->name }}</a></td>
                        @else
                        <td><a href="{{ action('User\MusicController@showAudio', $audio['id']) }}" class="play-audio" key="{{ $key }}" id="album-detail{{ $key }}">{{ $audio->name }}</a></td>
                        @endif
                        <td><a href="{{ $audio->singer_id ? action('User\SingerController@show', $audio->singer_id) : null }}">
                            {{ $audio->singer_id ? $audio->singer->name : config('settings.null') }}
                        </div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('user.music_detail.suggest_music')

    @include('user.music_detail.comment')

@endsection
