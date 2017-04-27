<!DOCTYPE Html>
<Html>
<head>
    <title>{{ trans('frontend.fim') }}</title>
    {{ Html::style('bower_components/bootstrap/dist/css/bootstrap.css') }}
    {{ Html::style('frontend/css/mystyle.css') }}
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div  class="nav navbar-nav navbar-left">
                    <!-- LOGO -->
                </div>
                <ul class="form-search">
                    {!! Form::open([
                        'class' => 'navbar-form',
                    ]) !!}
                        <div class="form-group">
                            {!! Form::text ('search', null, [
                                'class' => 'form-control input-search',
                                'placeholder' => trans('frontend.search'),
                            ]) !!}
                            {!! Form::button(trans('frontend.search'), [
                                'type' => 'submit',
                                'class' => 'btn btn-default',
                            ]) !!}
                        </div>
                    {!! Form::close() !!}
                </ul>
            </div>
        </div>
    </nav>
    <div class="container item-menu">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"
                        data-toggle="dropdown"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"><!-- Album --><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><!-- Nhac Tre --></a></li>
                        <li><a href="#"><!-- Nhac Hai Ngoai --></a></li>
                        <li><a href="#"><!-- Nhac Que Huong --></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"
                        data-toggle="dropdown"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"><!-- Video --><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><!-- Nhac Tre --></a></li>
                        <li><a href="#"><!-- Nhac Hai Ngoai --></a></li>
                        <li><a href="#"><!-- Nhac Que Huong --></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"
                        data-toggle="dropdown"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"><!-- Nghe Sy --><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><!-- Quang Le --></a></li>
                        <li><a href="#"><!-- Thu Hien --></a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">{{ trans('frontend.login') }}</a></li>
            </ul>
        </div>
    </div>
    <div class="container fix-content">
        @yield('content')
    </div>
</body>
    {{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    {{ Html::script('bower_components/jquery/dist/jquery.js') }}
    {{ Html::script('frontend/js/myscript.js') }}
</Html>
