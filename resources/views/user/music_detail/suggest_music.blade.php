@if (isset($audiosOfSinger) && $audiosOfSinger->count())
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.music') }}<span>{{ $audiosOfSinger[0]->singer->name }}</span></h3>
    </div>
    @foreach ($audiosOfSinger as $audioOfSinger)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showAudio', $audioOfSinger['id']) }}" title="{{ $audioOfSinger->name }}">
            <img src="{{ ($audioOfSinger->hasCoverAudio()) ? config('settings.audio_cover_path') . $audioOfSinger->cover : $audioOfSinger->cover }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAudio', $audioOfSinger['id']) }}" class="" title="{{ $audioOfSinger->name }}">
            <div class="music-name">{{ $audioOfSinger->name }}</div>
        </a>
        <a href="" class="">
            <div class="singer-name">{{ ($audioOfSinger->singer_id) ? $audioOfSinger->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
@endif

@if (isset($videosOfSinger) && $videosOfSinger->count())
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.video') }}<span class="text-success">{{ $videosOfSinger[0]->singer->name }}</span></h3>
    </div>
    @foreach ($videosOfSinger as $videoOfSinger)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showVideo', $videoOfSinger['id']) }}" title="{{ $videoOfSinger->name }}">
            <img src="{{ ($videoOfSinger->hasCoverAudio()) ? config('settings.audio_cover_path') . $videoOfSinger->cover : $videoOfSinger->cover }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAudio', $videoOfSinger['id']) }}" class="" title="{{ $videoOfSinger->name }}">
            <div class="music-name">{{ $videoOfSinger->name }}</div>
        </a>
        <a href="" class="">
            <div class="singer-name">{{ ($videoOfSinger->singer_id) ? $videoOfSinger->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
@endif

@if (isset($albumOfTopics) && $albumOfTopics->count())
    <div class="col-lg-12">
        <h3 class="page-header">{{ trans('home.same-topic-album') }}<span class="text-success">{{ ($albumOfTopics[0]->category) ? $albumOfTopics[0]->category->name : config('settings.null') }}</span></h3>
    </div>
    @foreach ($albumOfTopics as $albumOfTopic)
    <div class="col-sm-3 list">
        <a href="{{ action('User\MusicController@showAlbum', $albumOfTopic['id']) }}" title="{{ $albumOfTopic->name }}">
            <img src="{{ ($albumOfTopic->hasCoverAlbum()) ? config('settings.album_cover_path') . $albumOfTopic->cover : config('settings.album_cover_path') . config('settings.cover_default') }}" class="img-responsive music-cover">
        </a>
        <a href="{{ action('User\MusicController@showAudio', $albumOfTopic['id']) }}" class="" title="{{ $albumOfTopic->name }}">
            <div class="music-name">{{ $albumOfTopic->name }}</div>
        </a>
        <a href="" class="">
            <div class="singer-name">{{ ($albumOfTopic->singer_id) ? $albumOfTopic->singer->name : config('settings.null') }}</div>
        </a>
    </div>
    @endforeach
@endif
