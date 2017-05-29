<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('settings.title.home') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::style('bower_components/metisMenu/dist/metisMenu.min.css') !!}
    {!! Html::style('bower_components/startbootstrap-sb-admin-2-sass/dist/css/sb-admin-2.css') !!}
    {!! Html::style('bower_components/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')!!}
    {!! Html::style('bower_components/bootstrap-star-rating/css/star-rating.css')!!}
    {!! Html::style('bower_components/bootstrap-star-rating/css/theme-krajee-fa.min.css')!!}
    {!! Html::style('css/user/home-page.css') !!}
    {!! Html::style('css/user/rate.css') !!}
    @yield('item')
</head>
<body>
    @include('user.header')

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-9 text-left">
                @yield('content')
            </div>
            <div class="col-sm-3 sidenav">
                <div class="well">
                    <p>{{ trans('home.rate') }}</p>
                </div>
                <div class="well">
                    <p>{{ trans('home.rate') }}</p>
                </div>
            </div>
        </div>
    </div>

    @include('user.footer')

    {!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
    {!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! Html::script('bower_components/bootstrap-star-rating/js/star-rating.min.js') !!}
    {!! Html::script('bower_components/bootstrap-star-rating/js/star-rating_locale_Lang.js') !!}
    {!! Html::script('js/user/rate.js') !!}
    {!! Html::script('js/user/home-page.js') !!}
    @yield('script')
</body>
</html>
