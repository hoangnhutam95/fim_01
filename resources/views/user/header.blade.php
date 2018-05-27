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
                    <img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />
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
                    <li><a href="{{ route('login') }}" data-toggle="modal" data-target="#login-modal">{{ trans('auth.login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ trans('auth.register') }}</a></li>

                    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="mymodallabel" aria-hidden="true" style="display: none;">
                        <div class="modal-2">
                        <div class="omb_login">
                            <h3 class="omb_authTitle">Login or <a href="{{ route('register') }}">{{ trans('auth.signup') }}</a></h3>
                            <div class="row omb_row-sm-offset-3 omb_socialButtons">
                                <div class="col-xs-4 col-sm-3">
                                <a href="redirect/facebook" class="btn btn-lg btn-block omb_btn-facebook">
                                        <i class="fa fa-facebook visible-xs"></i>
                                        <span class="hidden-xs">Facebook</span>
                                    </a>
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <a href="#" class="btn btn-lg btn-block omb_btn-google">
                                        <i class="fa fa-google-plus visible-xs"></i>
                                        <span class="hidden-xs">Google+</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row omb_row-sm-offset-3 omb_loginOr">
                                <div class="col-xs-12 col-sm-6">
                                    <hr class="omb_hrOr">
                                    <span class="omb_spanOr">or</span>
                                </div>
                            </div>

                            <div class="row omb_row-sm-offset-3">
                                <div class="col-xs-12 col-sm-6">
                                    {{ Form::open([
                                        'method' => 'POST',
                                        'class' => 'omb_loginForm',
                                        'action' => 'Auth\LoginController@login',
                                        'role' => 'form',
                                    ]) }}
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="erra help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        <span class="help-block"></span>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input id="password" type="password" class="form-control" name="password" required>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="erra help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                        <span class="help-block"></span>
                                        {{ Form::submit(trans('auth.login'), ['class' => 'btn btn-lg btn-primary btn-block']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            {{ Form::open() }}
                            <div class="row omb_row-sm-offset-3">
                                <div class="col-xs-12 col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="text">{{ trans('auth.remember_me') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <p class="omb_forgotPwd">
                                        <a href="#">Forgot password?</a>
                                    </p>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    </div>


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


<!-- Search Form -->
<!-- {!! Form::open([
    'method' => 'POST',
    'action' => ['User\HomeController@search'],
    'id' => 'labnol'
]) !!} -->

<!-- <form id="labnol" method="get" action="https://www.google.com/search"> -->
  <!-- <div class="speech">
  {!! Form::text ('search', isset($input) ? $input : null, [
    'placeholder' => 'Speak ',
    'id' => 'transcript'
    ]) !!} -->
    <!-- <input type="text" name="q" id="transcript" placeholder="Speak" /> -->
   <!--  <img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />
  </div> -->
<!-- </form> -->
<!-- {{ Form::close() }} -->

<!-- HTML5 Speech Recognition API -->
<script>
  function startDictation() {

    if (window.hasOwnProperty('webkitSpeechRecognition')) {

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "vi-VN";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('home-search-aria').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('home-search-form').submit();
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }

    }
  }
</script>
