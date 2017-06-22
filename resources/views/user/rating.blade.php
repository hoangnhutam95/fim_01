<div class="panel panel-primary text-left">
    <div class="panel-heading c-list">
        <span class="title">{{ trans('home.top-rate-audio') }}</span>
        <ul class="pull-right c-controls">
            <li></li>
        </ul>
    </div>
    <ul class="list-group contact-list-rate" id="contact-list">
        @php ($i = 0)
        @foreach ($topRateAudios as $topRateAudio)
        @php ($i++)
        <li class="list-group-item">
            <div class="col-sm-1"><span>{{ $i }}</span></div>
            <div class="col-sm-8">
                <span><a href="{{ action('User\MusicController@showAudio', $topRateAudio['id']) }}" title="{{ $topRateAudio->name }}">
                    <div class="rate-name">{{ $topRateAudio->name }}</div>
                </a></span><br>
                <span>
                    <a href="{{ $topRateAudio->singer_id ? action('User\SingerController@show', $topRateAudio->singer_id) : null }}" class="text-muted">
                        <div class="c-info">{{ ($topRateAudio->singer_id) ? $topRateAudio->singer->name : config('settings.null') }}</div>
                    </a>
                </span>
            </div>
            <div class="col-xs-12 col-sm-2">
                <span class="rate-point">{{ $topRateAudio->rate_point }}</span><br>
            </div>
            <div class="clearfix"></div>
        </li>
        @endforeach
    </ul>
</div>

<div class="panel panel-primary text-left">
    <div class="panel-heading c-list">
        <span class="title">{{ trans('home.top-rate-video') }}</span>
        <ul class="pull-right c-controls">
            <li></li>
        </ul>
    </div>
    <ul class="list-group contact-list-rate" id="contact-list">
        @php ($i = 0)
        @foreach ($topRateVideos as $topRateVideo)
        @php ($i++)
        <li class="list-group-item">
            <div class="col-sm-1"><span>{{ $i }}</span></div>
            <div class="col-sm-8">
                <span><a href="{{ action('User\MusicController@showVideo', $topRateVideo['id']) }}" title="{{ $topRateVideo->name }}">
                    <div class="rate-name">{{ $topRateVideo->name }}</div>
                </a></span><br>
                <span>
                    <a href="{{ $topRateVideo->singer_id ? action('User\SingerController@show', $topRateVideo->singer_id) : null }}" class="text-muted">
                        <div class="c-info">{{ ($topRateVideo->singer_id) ? $topRateVideo->singer->name : config('settings.null') }}</div>
                    </a>
                </span>
            </div>
            <div class="col-xs-12 col-sm-2">
                <span class="rate-point">{{ $topRateVideo->rate_point }}</span><br>
            </div>
            <div class="clearfix"></div>
        </li>
        @endforeach
    </ul>
</div>

<div class="panel panel-primary text-left">
    <div class="panel-heading c-list">
        <span class="title">{{ trans('home.top-rate-album') }}</span>
        <ul class="pull-right c-controls">
            <li></li>
        </ul>
    </div>
    <ul class="list-group contact-list-rate" id="contact-list">
        @php ($i = 0)
        @foreach ($topRateAlbums as $topRateAlbum)
        @php ($i++)
        <li class="list-group-item">
        <div class="col-sm-1"><span>{{ $i }}</span></div>
            <div class="col-sm-8">
                <span><a href="{{ action('User\MusicController@showAlbum', $topRateAlbum['id']) }}" title="{{ $topRateAlbum->name }}">
                    <div class="rate-name">{{ $topRateAlbum->name }}</div>
                </a></span>
            </div>
            <div class="col-xs-12 col-sm-2">
                <span class="rate-point">{{ $topRateAlbum->rate_point }}</span><br>
            </div>
            <div class="clearfix"></div>
        </li>
        @endforeach
    </ul>
</div>
