<header>
<nav class="navbar navbar-inverse">
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
        'class' => 'navbar-form navbar-left',
    ]) !!}
        <div class="form-group form-main-search">
            {!! Form::text ('search', isset($input) ? $input : null, [
                'class' => 'form-control main-search',
                'placeholder' => 'search ',
                ]) !!}
            {!! Form::button('<i class="fa fa-search"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-default',
                ]) !!}
            </div>
            {!! Form::close() !!}
            <ul class="nav navbar-nav navbar-right login">
                @if (Auth::guest())
                <li><a href="{{ route('login') }}">{{ trans('auth.login') }}</a></li>
                <li><a href="{{ route('register') }}">{{ trans('auth.register') }}</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
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
                    <li><a href="#">{{ trans('home.my-music') }}</a></li>
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
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ trans('home.ranking') }}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu"></ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
