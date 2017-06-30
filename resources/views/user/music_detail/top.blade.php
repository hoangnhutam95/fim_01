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
    <h2 class="text-primary">{{ trans('home.top-rate-list') }}</h2>
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
                'id' => 'audio-id',
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

@endsection
