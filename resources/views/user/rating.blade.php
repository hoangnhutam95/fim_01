<div class="row">
    <div class="col-sm-12">
        <h2>{{ trans('home.top-rate') }}</h2>
        <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-tabs-horizontal">
          <li class="active"><a href="#htab1" data-toggle="tab">{{ trans('home.audio') }}</a></li>
          <li><a href="#htab2" data-toggle="tab">{{ trans('home.video') }}</a></li>
          <li><a href="#htab3" data-toggle="tab">{{ trans('home.album') }}</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="htab1">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-rate-audio') }}</span>
                        <ul class="pull-right c-controls">
                            <a href="{{ action('User\HomeController@playRateTop') }}" class="play-rate-list">
                                <i class="glyphicon glyphicon-play"></i>{{  trans('home.play') }}
                            </a>
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
            </div>
            <div role="tabpanel" class="tab-pane fade" id="htab2">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-rate-video') }}</span>
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
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="htab3">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-rate-album') }}</span>
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
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h2>{{ trans('home.top-view-audio') }}</h2>
        <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-tabs-horizontal">
          <li class="active"><a href="#htab4" data-toggle="tab">{{ trans('home.week') }}</a></li>
          <li><a href="#htab5" data-toggle="tab">{{ trans('home.month') }}</a></li>
          <li><a href="#htab6" data-toggle="tab">{{ trans('home.all') }}</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="htab4">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-view-week') }}</span>
                        <ul class="pull-right c-controls">
                            <a href="{{ action('User\HomeController@playRateTop') }}" class="play-rate-list">
                                <i class="glyphicon glyphicon-play"></i>{{  trans('home.play') }}
                            </a>
                        </ul>
                    </div>
                    <ul class="list-group contact-list-rate" id="contact-list">
                        @php ($i = 0)
                        @foreach ($topViewWeekAudios as $topViewWeekAudio)
                        @php ($i++)
                        <li class="list-group-item">
                            <div class="col-sm-1"><span>{{ $i }}</span></div>
                            <div class="col-sm-8">
                                <span><a href="{{ action('User\MusicController@showAudio', $topViewWeekAudio->song->id) }}" title="{{ $topViewWeekAudio->song->name }}">
                                    <div class="rate-name">{{ $topViewWeekAudio->song->name }}</div>
                                </a></span><br>
                                <span>
                                    <a href="{{ $topViewWeekAudio->song->singer_id ? action('User\SingerController@show', $topViewWeekAudio->song->singer_id) : null }}" class="text-muted">
                                        <div class="c-info">{{ ($topViewWeekAudio->song->singer_id) ? $topViewWeekAudio->song->singer->name : config('settings.null') }}</div>
                                    </a>
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <span class="rate-point">{{ $topViewWeekAudio->view_count_week }}</span><br>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="htab5">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-view-month') }}</span>
                    </div>
                    <ul class="list-group contact-list-rate" id="contact-list">
                        @php ($i = 0)
                        @foreach ($topViewMonthAudios as $topViewMonthAudio)
                        @php ($i++)
                        <li class="list-group-item">
                            <div class="col-sm-1"><span>{{ $i }}</span></div>
                            <div class="col-sm-8">
                                <span><a href="{{ action('User\MusicController@showAudio', $topViewMonthAudio->song->id) }}" title="{{ $topViewMonthAudio->song->name }}">
                                    <div class="rate-name">{{ $topViewMonthAudio->song->name }}</div>
                                </a></span><br>
                                <span>
                                    <a href="{{ $topViewMonthAudio->song->singer_id ? action('User\SingerController@show', $topViewMonthAudio->song->singer_id) : null }}" class="text-muted">
                                        <div class="c-info">{{ ($topViewMonthAudio->song->singer_id) ? $topViewMonthAudio->song->singer->name : config('settings.null') }}</div>
                                    </a>
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <span class="rate-point">{{ $topViewMonthAudio->view_count_month }}</span><br>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="htab6">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-view-all') }}</span>
                    </div>
                    <ul class="list-group contact-list-rate" id="contact-list">
                        @php ($i = 0)
                        @foreach ($topViewAllAudios as $topViewAllAudio)
                        @php ($i++)
                        <li class="list-group-item">
                            <div class="col-sm-1"><span>{{ $i }}</span></div>
                            <div class="col-sm-8">
                                <span><a href="{{ action('User\MusicController@showAudio', $topViewAllAudio->song->id) }}" title="{{ $topViewAllAudio->song->name }}">
                                    <div class="rate-name">{{ $topViewAllAudio->song->name }}</div>
                                </a></span><br>
                                <span>
                                    <a href="{{ $topViewAllAudio->song->singer_id ? action('User\SingerController@show', $topViewAllAudio->song->singer_id) : null }}" class="text-muted">
                                        <div class="c-info">{{ ($topViewAllAudio->song->singer_id) ? $topViewAllAudio->song->singer->name : config('settings.null') }}</div>
                                    </a>
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <span class="rate-point">{{ $topViewAllAudio->view_count_all }}</span><br>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h2>{{ trans('home.top-view-video') }}</h2>
        <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-tabs-horizontal">
          <li class="active"><a href="#htab7" data-toggle="tab">{{ trans('home.week') }}</a></li>
          <li><a href="#htab8" data-toggle="tab">{{ trans('home.month') }}</a></li>
          <li><a href="#htab9" data-toggle="tab">{{ trans('home.all') }}</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="htab7">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-view-week') }}</span>
                        <ul class="pull-right c-controls">
                            <a href="{{ action('User\HomeController@playRateTop') }}" class="play-rate-list">
                                <i class="glyphicon glyphicon-play"></i>{{  trans('home.play') }}
                            </a>
                        </ul>
                    </div>
                    <ul class="list-group contact-list-rate" id="contact-list">
                        @php ($i = 0)
                        @foreach ($topViewWeekVideos as $topViewWeekVideo)
                        @php ($i++)
                        <li class="list-group-item">
                            <div class="col-sm-1"><span>{{ $i }}</span></div>
                            <div class="col-sm-8">
                                <span><a href="{{ action('User\MusicController@showVideo', $topViewWeekVideo->song->id) }}" title="{{ $topViewWeekVideo->song->name }}">
                                    <div class="rate-name">{{ $topViewWeekVideo->song->name }}</div>
                                </a></span><br>
                                <span>
                                    <a href="{{ $topViewWeekVideo->song->singer_id ? action('User\SingerController@show', $topViewWeekVideo->song->singer_id) : null }}" class="text-muted">
                                        <div class="c-info">{{ ($topViewWeekVideo->song->singer_id) ? $topViewWeekVideo->song->singer->name : config('settings.null') }}</div>
                                    </a>
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <span class="rate-point">{{ $topViewWeekVideo->view_count_week }}</span><br>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="htab8">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-view-month') }}</span>
                    </div>
                    <ul class="list-group contact-list-rate" id="contact-list">
                        @php ($i = 0)
                        @foreach ($topViewMonthVideos as $topViewMonthVideo)
                        @php ($i++)
                        <li class="list-group-item">
                            <div class="col-sm-1"><span>{{ $i }}</span></div>
                            <div class="col-sm-8">
                                <span><a href="{{ action('User\MusicController@showVideo', $topViewMonthVideo->song->id) }}" title="{{ $topViewMonthVideo->song->name }}">
                                    <div class="rate-name">{{ $topViewMonthVideo->song->name }}</div>
                                </a></span><br>
                                <span>
                                    <a href="{{ $topViewMonthVideo->song->singer_id ? action('User\SingerController@show', $topViewMonthVideo->song->singer_id) : null }}" class="text-muted">
                                        <div class="c-info">{{ ($topViewMonthVideo->song->singer_id) ? $topViewMonthVideo->song->singer->name : config('settings.null') }}</div>
                                    </a>
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <span class="rate-point">{{ $topViewMonthVideo->view_count_month }}</span><br>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="htab9">
                <div class="panel panel-primary text-left">
                    <div class="panel-heading c-list">
                        <span class="title">{{ trans('home.top-view-all') }}</span>
                    </div>
                    <ul class="list-group contact-list-rate" id="contact-list">
                        @php ($i = 0)
                        @foreach ($topViewAllVideos as $topViewAllVideo)
                        @php ($i++)
                        <li class="list-group-item">
                            <div class="col-sm-1"><span>{{ $i }}</span></div>
                            <div class="col-sm-8">
                                <span><a href="{{ action('User\MusicController@showVideo', $topViewAllVideo->song->id) }}" title="{{ $topViewAllVideo->song->name }}">
                                    <div class="rate-name">{{ $topViewAllVideo->song->name }}</div>
                                </a></span><br>
                                <span>
                                    <a href="{{ $topViewAllVideo->song->singer_id ? action('User\SingerController@show', $topViewAllVideo->song->singer_id) : null }}" class="text-muted">
                                        <div class="c-info">{{ ($topViewAllVideo->song->singer_id) ? $topViewAllVideo->song->singer->name : config('settings.null') }}</div>
                                    </a>
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <span class="rate-point">{{ $topViewAllVideo->view_count_all }}</span><br>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
