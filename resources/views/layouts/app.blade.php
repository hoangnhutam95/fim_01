<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>

    <!-- Styles -->
    {!! Html::style('css/app.css') !!}
    {!! Html::style('css/user/login.css') !!}
    {!! Html::style('css/user/home-page.css') !!}
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse nav-custom-2">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="logo">
                    <a href="{{ action('User\HomeController@index') }}">
                        {{ HTML::image(config('settings.logo')) }}
                    </a>
                </div>
            </div>
        </div>
    </nav>
    </br>
    </br>
        @yield('content')
    </div>

    <!-- Scripts -->
    {!! Html::script('js/app.js') !!}
</body>
</html>
