<div class="lyric">
    <div class="name-lyric">{{ trans('home.lyric') }}</div>
    <div>{{ ($currentLyric) ? trans('lyric.user-suggest-lyric').':' : ''}} {{ ($currentLyric) ? $currentLyric->user->name : ''}}</div>
    <div class="more">{{ ($currentLyric) ? $currentLyric->content : config('settings.null') }}</div>
    @if (auth::check())
        {!! Form::button(trans('home.suggest-lyric'), [
            'class' => 'btn btn-primary pull-right suggest-bnt',
            'id' => 'suggest_bnt',
        ]) !!}
    <div class="none" id="suggest-lyric">
        {!! Form::open() !!}
            <div class="urlsuggest" data-route="{{ url('suggest-lyric') }}"></div>
            {!! Form::textarea('content', null, [
                'class' => 'form-control',
                'id' => "suggest-aria",
                'placeholder' => trans('home.input-lyric'),
                'cols' => '50',
                'rows' => '3',
            ]) !!}
            {!! Form::hidden('user_id', Auth::user()->id, [
                'id' => 'user_id',
            ]) !!}
            {!! Form::button(trans('home.suggest'), [
                'class' => 'btn btn-primary suggest-bnt',
                'id' => 'summit-suggest',
                'type' => 'submit',
            ]) !!}
        {!! Form::close() !!}
    </div>
    <div class="thanks"></div>
    @endif
</div>
