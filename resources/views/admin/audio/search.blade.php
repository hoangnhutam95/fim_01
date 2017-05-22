@if ($audios->count())
    @foreach ($audios as $audio)
        {!! Form::open() !!}
            {!! Form::hidden('audio_id', $audio->id, [
                'id' => 'audio-id',
            ]) !!}
            {!! Form::hidden('src', ($audio->hasFileAudio()) ? config('settings.audio_path') . $audio->link : $audio->link, [
                'id' => 'link-audio' . $audio->id,
            ]) !!}
            {!! Form::hidden('cover-audio', ($audio->hasCoverAudio()) ? config('settings.audio_cover_path') . $audio->cover : $audio->cover , [
                'id' => 'cover-audio' . $audio->id,
            ]) !!}
            {!! Form::hidden('audio-name', $audio->name, [
                'id' => 'audio-name' . $audio->id,
            ]) !!}
        {!! Form::close() !!}
        <div class="member-entry cover-song">
            <div class="member-details">
                <div class="col-lg-10">
                    <h4><a href="" class="play-audio" id = {{ $audio->id }}>{{ $audio->name }}</a></h4>
                </div>
                <div class="col-lg-1">
                    <a href="{{ action('Admin\AudioController@edit', $audio->id) }}" class="btn btn-block btn-primary btn-xs">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </div>
                <div class="col-lg-1">
                    {!! Form::open([
                        'action' => ['Admin\AudioController@destroy', $audio['id']],
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
                        <span class="text-primary">{{ $audio->singer_id ? $audio->singer->name : config('settings.null') }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.composed') }}</span>
                        <span class="text-primary">{{ $audio->author ?: config('settings.null') }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.category') }}</span>
                        <span class="text-primary">{{ ($audio->category) ? $audio->category->name : config('settings.null') }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.rate_point') }}</span>
                        <span class="text-primary">{{ $audio->rate_point }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.rate_number') }}</span>
                        <span class="text-primary">{{ $audio->rate_number }}</span>
                    </div>
                    <div class="col-lg-4">
                        <span>{{ trans('song.comment_number') }}</span>
                        <span class="text-primary">{{ $audio->comment_number }}</span>
                    </div>
                    <div class="col-lg-12">
                        <span>{{ trans('song.description') }}</span>
                        <span class="more">{{ ($audio->description) ?: config('settings.null') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-12 search-page">{{ $audios->links() }}</div>
@else
<h2 class="search-title">{{ trans('song.no_result') }}</h2>
@endif
