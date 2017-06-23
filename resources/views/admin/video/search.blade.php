@if ($videos->count())
    @foreach ($videos as $video)
        {!! Form::open() !!}
            {!! Form::hidden('video_id', $video->id, [
                'id' => 'video-id',
            ]) !!}
            {!! Form::hidden('src', ($video->hasFileVideo()) ? config('settings.video_path') . $video->link : $video->link, [
                'id' => 'link-video' . $video->id,
            ]) !!}
            {!! Form::hidden('cover-video', ($video->hasCoverVideo()) ? config('settings.video_cover_path') . $video->cover : config('settings.video_cover_path') . config('settings.cover_default'), [
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
                        <span>{{ trans('song.singer') }}</span>
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
    <div class="col-md-12 search-page">{{ $videos->links() }}</div>
@else
<h2 class="search-title">{{ trans('song.no_result') }}</h2>
@endif
