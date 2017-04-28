@extends('frontend.master')
@section('videoCss')
    {{ Html::style('frontend/css/video/video-js-5.4.6.css') }}
    {{ Html::style('frontend/css/video/styles.css') }}
@stop
@section('content')
<section class="">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Video Demo</h1>

            <h2>Video Player</h2>
        </div>
    </div>

    <div class="row" style="background: black;">
        <video poster="" id="MyVideo" class="video-js"
               data-setup='{
                       "controls": true,
                       "preload": "auto",
                       "width": 800, "height": 450,
                       "controlBar": {
                       }
                   }'
               style="margin: 0 auto;">
            <source type='video/mp4' src="{{ asset('video/mov_bbb.mp4') }}">
        </video>
    </div>
</section>
@endsection
@section('videoJs')
    {{ Html::script('frontend/js/video/video-js-5.4.6.js') }}
    {{ Html::script('frontend/js/video/myscript.js') }}
@stop
