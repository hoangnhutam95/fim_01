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
    {!! Html::style('css/user/comment.css') !!}
    @yield('item')
</head>
<body>
    @include('user.header')

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-9 text-left">
                @if (Session::has('flash_message'))
                    <div class="alert alert-{!! Session::get('flash_level') !!}">
                        {!! Session::get('flash_message') !!}
                    </div>
                @endif
                @yield('content')
            </div>
            <div class="col-sm-3">
                @include('user.rating')
            </div>
        </div>
    </div>

    @include('user.footer')

    {!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
    {!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! Html::script('bower_components/bootstrap-star-rating/js/star-rating.min.js') !!}
    {!! Html::script('js/rate.js') !!}
    {!! Html::script('js/user/comment.js') !!}
    {!! Html::script('js/user/home-page.js') !!}
    {!! Html::script('js/user/suggest-lyrics.js') !!}
    {!! Html::script('js/user/search.js') !!}
    @yield('script')
</body>
</html>
