<ul class="dropdown-menu suggest-search-aria">
    @if (isset($searchAudios) && $searchAudios->count())
    <li class="dropdown-header">{{ trans('home.audio') }}</li>
        @foreach ($searchAudios as $searchAudio)
        <li><a href="{{ action('User\MusicController@showAudio', $searchAudio['id']) }}">{{ $searchAudio->name }} - {{ ($searchAudio->singer_id) ? $searchAudio->singer->name : config('settings.null') }}</a></li>
        @endforeach
        <li class="divider"></li>
    @endif
    @if (isset($searchVideos) && $searchVideos->count())
        <li class="dropdown-header">{{ trans('home.video') }}</li>
        @foreach ($searchVideos as $searchVideo)
        <li><a href="{{ action('User\MusicController@showVideo', $searchVideo['id']) }}">{{ $searchVideo->name }} - {{ ($searchVideo->singer_id) ? $searchVideo->singer->name : config('settings.null') }}</a></li>
        @endforeach
        <li class="divider"></li>
    @endif
    @if (isset($searchAlbums) && ($searchAlbums->count()))
        <li class="dropdown-header">{{ trans('home.album') }}</li>
        @foreach ($searchAlbums as $searchAlbum)
        <li><a href="{{ action('User\MusicController@showAlbum', $searchAlbum['id']) }}">{{ $searchAlbum->name }}</a></li>
        @endforeach
        <li class="divider"></li>
    @endif
    @if (isset($searchSingers) && $searchSingers->count())
        <li class="dropdown-header">{{ trans('home.singer') }}</li>
        @foreach ($searchSingers as $searchSinger)
        <li><a href="{{ action('User\SingerController@show', $searchSinger['id']) }}">{{ $searchSinger->name }}</a></li>
        @endforeach
    @endif
    @if (!$searchAudios->count() && !$searchVideos->count() && !$searchAlbums->count() && !$searchSingers->count())
        <h4>{{ trans('home.no_result') }}</h4>
    @endif
</ul>
