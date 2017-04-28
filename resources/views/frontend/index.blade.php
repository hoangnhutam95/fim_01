@extends('frontend.master')
@section('content')
<div class="row">
    <div class="col-md8">
        <div class="slide-img">
            {{ Html::image('img/frontend/album/d9112_khuc_tinh_x_a_2___nh_tl_.jpg', null, ['class' => 'mySlides']) }}
            {{ Html::image('img/frontend/album/s1_oump.jpg', null, ['class' => 'mySlides']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="title_item">
        <h3>{{ trans('frontend.album') }}</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            {{ Html::image('img/frontend/album/d9112_khuc_tinh_x_a_2___nh_tl_.jpg') }}
            <div class="caption">
                <h3><!-- Thumbnail label --></h3>
                <p><!-- abcnad --></p>
            </div>
        </div>
    </div>
</div>
<div class="title_item">
    <h3>{{ trans('frontend.video') }}</h3>
</div>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            {{ Html::image('img/frontend/album/d9112_khuc_tinh_x_a_2___nh_tl_.jpg') }}
            <div class="caption">
                <h3><!-- Thumbnail label --></h3>
                <p><!-- abcnad --></p>
            </div>
        </div>
    </div>
</div>
<div class="title_item">
    <h3>{{ trans('frontend.sigger') }}</h3>
</div>
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            {{ Html::image('img/frontend/album/d9112_khuc_tinh_x_a_2___nh_tl_.jpg') }}
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            {{ Html::image('img/frontend/album/d9112_khuc_tinh_x_a_2___nh_tl_.jpg') }}
        </div>
    </div>
</div>
@endsection
