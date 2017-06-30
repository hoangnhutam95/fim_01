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
@endsection

@section('content')
    <h2 class="text-primary">{{ trans('home.top-rate-list') }}</h2>
    @php ($i = 0)
    @php ($k = 0)
    <div class="audio-cover" backgr={{ ($views[0]->song->hasCoverAudio()) ? config('settings.audio_cover_path') . $views[0]->song->cover : config('settings.audio_cover_path') . config('settings.cover_default') }}>
        <div class="admin-audio-name">
            {{ trans('song.song') }}
            <span id="audio-name-color">{{ $views[0]->song->name }}</span>
        </div>
        <div class="plyr-1">
            <audio controls class="test-p" id='audio-view'>
                <source src="{{ config('settings.audio_path') . $views[0]->song->link }}" type="audio/mpeg">
                {{ trans('song.brower_not_support') }}
            </audio>
        </div>
    </div>
    @foreach ($views as $key => $view )
        @php ($k++)
        {!! Form::open() !!}
            {!! Form::hidden('audio_id', $view->song->id, [
                'id' => 'audio-id' . $key,
            ]) !!}
            {!! Form::hidden('src', ($view->song->hasFileAudio()) ? config('settings.audio_path') . $view->song->link : $view->song->link, [
                'id' => 'link-audio' . $key,
            ]) !!}
            {!! Form::hidden('cover-audio', ($view->song->hasCoverAudio()) ? config('settings.audio_cover_path') . $view->song->cover : config('settings.audio_cover_path') . config('settings.cover_default'), [
                'id' => 'cover-audio' . $key,
            ]) !!}
            {!! Form::hidden('audio-name', $view->song->name, [
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
                @foreach ($views as $key => $view )
                    <tr>
                        @if ($view == $views[0])
                        <td><a href="{{ action('User\MusicController@showAudio', $view->song->id) }}" class="play-audio album-active" key="{{ $key }}" id="album-detail{{ $key }}">{{ $view->song->name }}</a></td>
                        @else
                        <td><a href="{{ action('User\MusicController@showAudio', $view->song['id']) }}" class="play-audio" key="{{ $key }}" id="album-detail{{ $key }}">{{ $view->song->name }}</a></td>
                        @endif
                        <td><a href="{{ $view->song->singer_id ? action('User\SingerController@show', $view->song->singer_id) : null }}">
                            {{ $view->song->singer_id ? $view->song->singer->name : config('settings.null') }}
                        </div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
