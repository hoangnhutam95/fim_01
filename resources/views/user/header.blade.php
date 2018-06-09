<header>
    <nav class="navbar navbar-inverse nav-custom-2">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="logo">
                    <a href="{{ action('User\HomeController@index') }}">
                        {{ HTML::image(config('settings.logo')) }}
                    </a>
                </div>
            </div>
            {!! Form::open([
                'method' => 'POST',
                'action' => ['User\HomeController@search'],
                'class' => 'navbar-form navbar-left',
                'id' => 'home-search-form'
            ]) !!}
                <div class="route-search-home" data-route={{ url('search-home') }}></div>
                <div class="form-group form-main-search">
                    <img onclick="startDictation()" class="mic-icon" src="{{ config('settings.mic_icon') }}" />
                    {!! Form::text ('search', isset($input) ? $input : null, [
                        'class' => 'form-control main-search',
                        'placeholder' => 'Search ',
                        'id' => 'home-search-aria'
                    ]) !!}
                    {!! Form::button('<i class="fa fa-search"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-default',
                    ]) !!}
                </div>
                <div class="dropdown" id="suggest-search-aria">

                </div>
            {!! Form::close() !!}
            <ul class="nav navbar-nav navbar-right login">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}"><strong class="text-success">{{ trans('auth.login') }}</strong></a></li>
                    <li><a href="{{ route('register') }}"><strong class="text-success">{{ trans('auth.register') }}</strong></a></li>

                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ HTML::image((auth::user()->hasAvatar()) ? config('settings.avatar') . auth::user()->avatar : auth::user()->avatar, trans('user.this-is-avatar'),
                                [
                                    'class' => 'img-avatar',
                                ])
                            }}
                            <span class="user-name">{{ Auth::user()->name }}</span> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="" id="click-submit-logout">
                                    {{ trans('auth.logout') }}
                                </a>
                                {{ Form::open([
                                    'id' => 'logout-form',
                                    'action' => 'Auth\LoginController@logout',
                                    'method' => 'POST',
                                ]) }}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
<nav class="navbar nav-custom-1">
    <div class="container-fluid">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="{{ action('User\UserController@myMusic') }}">{{ trans('home.my-music') }}</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('home.topic') }}<b class="caret"></b></a>
                    <ul class="dropdown-menu topic">
                        <ul class="list-inline">
                            @foreach ($songCategories as $category)
                            <li><a href="{{ action('User\HomeController@showSongOfTopic', $category['id']) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('home.album') }}<b class="caret"></b></a>
                    <ul class="dropdown-menu topic">
                        <ul class="list-inline">
                            @foreach ($albumCategories as $category)
                            <li><a href="{{ action('User\HomeController@showAlbumOfTopic', $category['id']) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('home.video') }}<b class="caret"></b></a>
                    <ul class="dropdown-menu topic">
                        <ul class="list-inline">
                            @foreach ($songCategories as $category)
                            <li><a href="{{ action('User\HomeController@showVideoOfTopic', $category['id']) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </ul>
                </li>
                <li><a href="{{ action('User\SingerController@index') }}">{{ trans('home.singer') }}</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function startDictation() {

        if (window.hasOwnProperty('webkitSpeechRecognition')) {

            var recognition = new webkitSpeechRecognition();

            recognition.continuous = false;
            recognition.interimResults = false;

            recognition.lang = "vi-VN";
            $(".mic-icon").attr("src", "{{ config('settings.mic_icon_on') }}");
            recognition.start();

            recognition.onresult = function(e) {
                document.getElementById('home-search-aria').value = e.results[0][0].transcript;
                recognition.stop();
                $(".mic-icon").attr("src", "{{ config('settings.mic_icon') }}");
                document.getElementById('home-search-form').submit();
            };
            recognition.onerror = function(e) {
                recognition.stop();
                $(".mic-icon").attr("src", "{{ config('settings.mic_icon') }}");
            }
        }
    }
</script>
