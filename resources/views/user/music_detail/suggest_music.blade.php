@if (isset($audiosOfSinger) && $audiosOfSinger->count())
    <div class="col-sm-12">
        <a href="{{ action('User\SingerController@showAudio', $audiosOfSinger[0]->singer_id) }}">
            <h3 class="page-header">{{ trans('home.audio2') }}<span class="text-success">{{ $audiosOfSinger[0]->singer->name }}</span></h3>
        </a>
    </div>
    @foreach ($audiosOfSinger as $audioOfSinger)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showAudio', $audioOfSinger['id']) }}" title="{{ $audioOfSinger->name }}">
            <img src="{{ ($audioOfSinger->hasCoverAudio()) ? config('settings.audio_cover_path') . $audioOfSinger->cover : config('settings.audio_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAudio', $audioOfSinger['id']) }}" class="" title="{{ $audioOfSinger->name }}">
            <div class="music-name">{{ $audioOfSinger->name }}</div>
        </a>
        <a href="{{ $audioOfSinger->singer_id ? action('User\SingerController@show', $audioOfSinger->singer_id) : null }}" class="">
            <div class="singer-name">{{ ($audioOfSinger->singer_id) ? $audioOfSinger->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
@endif

@if (isset($videosOfSinger) && $videosOfSinger->count())
    <div class="col-sm-12">
        <a href="{{ action('User\SingerController@showVideo', $videosOfSinger[0]->singer_id) }}">
            <h3 class="page-header">{{ trans('home.video') }}<span class="text-success">{{ $videosOfSinger[0]->singer->name }}</span></h3>
        </a>
    </div>
    @foreach ($videosOfSinger as $videoOfSinger)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showVideo', $videoOfSinger['id']) }}" title="{{ $videoOfSinger->name }}">
            <img src="{{ ($videoOfSinger->hasCoverAudio()) ? config('settings.video_cover_path') . $videoOfSinger->cover : config('settings.video_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAudio', $videoOfSinger['id']) }}" class="" title="{{ $videoOfSinger->name }}">
            <div class="music-name">{{ $videoOfSinger->name }}</div>
        </a>
        <a href="{{ $videoOfSinger->singer_id ? action('User\SingerController@show', $videoOfSinger->singer_id) : null }}" class="">
            <div class="singer-name">{{ ($videoOfSinger->singer_id) ? $videoOfSinger->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
@endif

@if (isset($audiosOfTopic) && $audiosOfTopic->count())
    <div class="col-sm-12">
        <a href="{{ action('User\HomeController@showSongOfTopic', $audiosOfTopic[0]->category_id) }}">
            <h3 class="page-header">{{ trans('home.audio2') }}<span class="text-success">{{ $audiosOfTopic[0]->category->name }}</span></h3>
        </a>
    </div>
    @foreach ($audiosOfTopic as $audioOfTopic)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showAudio', $audioOfTopic['id']) }}" title="{{ $audioOfTopic->name }}">
            <img src="{{ ($audioOfTopic->hasCoverAudio()) ? config('settings.audio_cover_path') . $audioOfTopic->cover : config('settings.audio_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAudio', $audioOfTopic['id']) }}" class="" title="{{ $audioOfTopic->name }}">
            <div class="music-name">{{ $audioOfTopic->name }}</div>
        </a>
        <a href="{{ $audioOfTopic->singer_id ? action('User\SingerController@show', $audioOfTopic->singer_id) : null }}" class="">
            <div class="singer-name">{{ ($audioOfTopic->singer_id) ? $audioOfTopic->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
@endif

@if (isset($videosOfTopic) && $videosOfTopic->count())
    <div class="col-sm-12">
        <a href="{{ action('User\HomeController@showVideoOfTopic', $videosOfTopic[0]->category_id) }}">
            <h3 class="page-header">{{ trans('home.video') }}<span class="text-success">{{ $videosOfTopic[0]->category->name }}</span></h3>
        </a>
    </div>
    @foreach ($videosOfTopic as $videoOfTopic)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showVideo', $videoOfTopic['id']) }}" title="{{ $videoOfTopic->name }}">
            <img src="{{ ($videoOfTopic->hasCoverVideo()) ? config('settings.video_cover_path') . $videoOfTopic->cover : config('settings.video_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showVideo', $videoOfTopic['id']) }}" class="" title="{{ $videoOfTopic->name }}">
            <div class="music-name">{{ $videoOfTopic->name }}</div>
        </a>
        <a href="{{ $videoOfTopic->singer_id ? action('User\SingerController@show', $videoOfTopic->singer_id) : null }}" class="">
            <div class="singer-name">{{ ($videoOfTopic->singer_id) ? $videoOfTopic->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
@endif

@if (isset($albumOfTopics) && $albumOfTopics->count())
    <div class="col-sm-12">
        <a href="{{ action('User\HomeController@showAlbumOfTopic', $albumOfTopics[0]->category_id) }}">
            <h3 class="page-header">{{ trans('home.same-topic-album') }}<span class="text-success">{{ ($albumOfTopics[0]->category) ? $albumOfTopics[0]->category->name : config('settings.null') }}</span></h3>
        </a>
    </div>
    @foreach ($albumOfTopics as $albumOfTopic)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showAlbum', $albumOfTopic['id']) }}" title="{{ $albumOfTopic->name }}">
            <img src="{{ ($albumOfTopic->hasCoverAlbum()) ? config('settings.album_cover_path') . $albumOfTopic->cover : config('settings.album_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAudio', $albumOfTopic['id']) }}" class="" title="{{ $albumOfTopic->name }}">
            <div class="music-name">{{ $albumOfTopic->name }}</div>
        </a>
    </div>
    @endforeach
@endif

@if (isset($favoriteOfUsers) && $favoriteOfUsers->count())
    <div class="col-sm-12">
        <a href="{{ action('User\UserController@myMusic') }}">
            <h3 class="page-header">{{ trans('home.my-playlist') }}</h3>
        </a>
    </div>
    @foreach ($favoriteOfUsers as $favoriteOfUser)
    <div class="col-sm-3 list">
        <a href="{{ action('User\FavoriteController@show', $favoriteOfUser['id']) }}" title="{{ $favoriteOfUser->name }}">
            <img src="{{ ($favoriteOfUser->hasCoverFavorite()) ? config('settings.favorite_cover_path') . $favoriteOfUser->cover : config('settings.favorite_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\FavoriteController@show', $favoriteOfUser['id']) }}" title="{{ $favoriteOfUser->name }}">
            <div class="music-name">{{ $favoriteOfUser->name }}</div>
        </a>
        <div class="">
            <div class="singer-name text-muted">{{ $favoriteOfUser->favoriteDetails->count() }}{{ trans('home.song') }}</div>
        </div>
    </div>
    @endforeach
@endif
