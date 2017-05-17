@extends('admin.master')

@section('style')
    {!! Html::style('css/manage-user.css') !!}
    {!! Html::style('bower_components/plyr/dist/plyr.css') !!}
    {!! Html::style('css/video-media.css') !!}
@endsection
@section('script')
    {!! Html::script('bower_components/plyr/dist/plyr.js') !!}
    {!! Html::script('js/video-media.js') !!}
    {!! Html::script('js/show-more.js') !!}
@endsection
@section('content')
    @if (Session::has('errors'))
        <div class="alert alert-danger">
            {{ Session::get('errors') }}
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="video-cover">
        <div class="admin-video-name">
            {{ trans('song.song') }}
            <span id="video-name-color">{{ $videos[0]->name }}</span>
            <span> - {{ $videos[0]->singer->name }}</span>
        </div>
        <video poster="{{ ($videos[0]->hasCoverVideo()) ? config('settings.video_cover_path') . $videos[0]->cover : $videos[0]->cover }}" controls id='video-view'>
        <source src="{{ config('settings.video_path') . $videos[0]->link }}" type="video/mp4">
        </video>
    </div>
    <div class="add-video">
        <a class="btn btn-primary pull-right" href="{{ action('Admin\VideoController@create') }}">
            <i class="fa fa-plus"></i> {{ trans('song.add-video') }}
        </a>
    </div>
    <div class="row bootstrap snippets">
        <div class="col-md-9 col-sm-7">
            <h2>{{ trans('song.list-video') }}</h2>
        </div>
    </div>
    <form method="get" role="form" class="search-form-full">
        <div class="form-group">
            <input type="text" class="form-control" name="s" id="search-input" placeholder="Search...">
            <i class="entypo-search"></i>
        </div>
    </form>

    @foreach($videos as $video)
        {!! Form::open() !!}
            {!! Form::hidden('video_id', $video->id, [
                'id' => 'video-id',
            ]) !!}
            {!! Form::hidden('src', ($video->hasFileVideo()) ? config('settings.video_path') . $video->link : $video->link, [
                'id' => 'link-video' . $video->id,
            ]) !!}
            {!! Form::hidden('cover-video', ($video->hasCoverVideo()) ? config('settings.video_cover_path') . $video->cover : $video->cover , [
                'id' => 'cover-video' . $video->id,
            ]) !!}
            {!! Form::hidden('video-name', $video->name, [
                'id' => 'video-name' . $video->id,
            ]) !!}
            {!! Form::hidden('singer-name', $video->singer_id ? $video->singer->name : config('settings.null'), [
                'id' => 'singer-name' . $video->id,
            ]) !!}
        {!! Form::close() !!}
        <div class="member-entry cover-song">
            <div class="member-details">
                <div class="col-lg-10">
                    <h4><a href="" class="play-video" id = {{ $video->id }}>{{ $video->name }}</a></h4>
                </div>
                <div class="col-lg-1">
                    <a href="{{ action('Admin\VideoController@edit', $video->id) }}" class="btn btn-block btn-primary btn-xs">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </div>
                <div class="col-lg-1">
                    {!! Form::open([
                        'action' => ['Admin\VideoController@destroy', $video['id']],
                        'method' => 'delete',
                        ])
                    !!}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                        'class' => 'btn btn-block btn-danger btn-xs delete-button',
                        'type' => 'submit',
                        ])
                    !!}
                    {{ Form::close() }}
                </div>
                <div class="row info-list">
                    <div class="col-lg-4">
                        <span>{{ trans('song.singer') }}
                        <span class="text-primary">{{ $video->singer_id ? $video->singer->name : config('settings.null') }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.composed') }}</span>
                        <span class="text-primary">{{ $video->author ?: config('settings.null') }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.category') }}</span>
                        <span class="text-primary">{{ ($video->category) ? $video->category->name : config('settings.null') }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.rate_point') }}</span>
                        <span class="text-primary">{{ $video->rate_point }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.rate_number') }}</span>
                        <span class="text-primary">{{ $video->rate_number }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.comment_number') }}</span>
                        <span class="text-primary">{{ $video->comment_number }}</span>
                    </div>
                    <div class="col-lg-12">
                        <span>{{ trans('song.description') }}</span>
                        <span class="more">{{ ($video->description) ?: config('settings.null') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-12">{{ $videos->links() }}</div>
@endsection
