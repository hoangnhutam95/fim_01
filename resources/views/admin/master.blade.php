<!DOCTYPE Html>
<Html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('admin.admin') }}</title>

    {!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::style('bower_components/metisMenu/dist/metisMenu.min.css') !!}
    {!! Html::style('bower_components/startbootstrap-sb-admin-2-sass/dist/css/sb-admin-2.css') !!}
    {!! Html::style('bower_components/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')!!}
    {!! Html::style('admin/mycss.css') !!}
    @yield('style')
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="javascript:void(0);">
                    {{ trans('admin.manage') }}
                </a>
            </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-dashboard fa-fw"></i>
                                {{ trans('admin.dasbroad') }}
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-bar-chart-o fa-fw"></i>
                                {{ trans('admin.category') }}
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ action('Admin\CategoryController@index') }}">{{ trans('admin.list-category') }}</a>
                                </li>
                                <li>
                                    <a href="{{ action('Admin\CategoryController@create') }}">{{ trans('admin.add-category') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-cube fa-fw"></i>
                                {{ trans('admin.music') }}
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ action('Admin\AudioController@index') }}">{{ trans('admin.audio') }}</a>
                                </li>
                                <li>
                                    <a href="{{ action('Admin\VideoController@index') }}"> {{ trans('admin.video') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ action('Admin\UserController@index') }}"><i class="fa fa-users fa-fw"></i>
                                {{ trans('admin.user') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('Admin\SingerController@index') }}"><i class="fa fa-users fa-fw"></i>
                                {{ trans('admin.singer') }}
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-users fa-fw"></i>
                                {{ trans('admin.album') }}
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">{{ trans('admin.list-album') }}</a>
                                </li>
                                <li>
                                    <a href="#">{{ trans('admin.add-album') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-users fa-fw"></i>
                                {{ trans('admin.lyrics') }}
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-users fa-fw"></i>
                                {{ trans('admin.hot-music') }}
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">{{ trans('admin.audio') }}</a>
                                </li>
                                <li>
                                    <a href="#">{{ trans('admin.video') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @if (Session::has('flash_message'))
                            <div class="alert alert-{!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message') !!}
                            </div>
                        @endif
                    </div>
                   @yield('content')
                </div>
            </div>
        </div>
    </div>

    {!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
    {!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! Html::script('bower_components/metisMenu/dist/metisMenu.min.js') !!}
    {!! Html::script('bower_components/startbootstrap-sb-admin-2-sass/dist/js/sb-admin-2.js') !!}
    {!! Html::script('admin/js/myscript.js') !!}
    @yield('script')
</body>
</Html>
