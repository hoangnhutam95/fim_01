@if (auth()->check())
    {!! Form::open() !!}
    <div class="urlcomment" data-route="{{ url('comment') }}"></div>
    {!! Form::textarea('content', null, [
        'class' => 'form-control fix-comment',
        'id' => "comment1",
        'placeholder' => trans('home.type-comment'),
        'cols' => '50',
        'rows' => '3',
    ]) !!}
    {!! Form::button(trans('home.send'), [
        'class' => 'btn btn-primary suggest-bnt',
        'id' => 'post-comment-1',
        'type' => 'submit',
    ]) !!}
    {!! Form::close() !!}
@else
    <div class="col-sm-12">
    <a href="{{ action('Auth\LoginController@login') }}" class="login-to-comment">{{  trans('home.login-to-comment') }}</a>
    </div>
@endif
@if (isset($album))
    <div class="comment-type" data-type-comment={{ config('settings.comment.album') }}></div>
@else
    <div class="comment-type" data-type-comment={{ config('settings.comment.song') }}></div>
@endif
<div class="row bootstrap snippets list-comment">
    <div class="col-md-12 col-md-offset-0 col-sm-12">
        <div class="comment-wrapper">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ trans('home.comment') }}({{ $comments->count() }})
                </div>
                <div class="panel-body" id="post-comment">
                    <ul class="media-list">
                    <div id = "edit-comment-aria"></div>
                    <div id = "comment2"></div>
                        @foreach ($comments as $comment)
                        <div id='location-comment{{ $comment->id }}'>
                            <li class="media">
                                <a href="#" class="pull-left">
                                    {{ HTML::image(($comment->user->hasAvatar()) ? config('settings.avatar') . $comment->user->avatar : config('settings.avatar') . config('settings.avatar_default'),
                                        trans('user.this-is-avatar'),
                                        [
                                            'class' => 'img-circle',
                                        ])
                                    }}
                                </a>
                                <span class="text-muted pull-right">
                                    @if (auth()->check() && (Auth::user()->id == $comment->user_id))
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" >
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu edit-comment-dropdown">
                                                <li><a href="" class='edit-comment' id={{ $comment->id }}>{{ trans('admin.edit') }}</a></li>
                                                <li>
                                                <a href="" class="delete-comment1" id="{{ $comment->id }}">{{ trans('admin.delete') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </span>
                                <div class="media-body">
                                    <strong class="text-success">{{ $comment->user->name }}</strong>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    <p id="content-comment{{ $comment->id }}">{{ $comment->content }}</p>
                                </div>
                            </li>
                        </div>
                        @endforeach
                    </ul>
                    <div class="col-md-12">{{ $comments->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
