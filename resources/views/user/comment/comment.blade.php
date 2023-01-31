@foreach($comments as $key => $comment)
    <div class="comment-item" style="@if($key > 2) display:none; @endif">
        @if(isset($comment->user->profile_avatar_url) && !empty($comment->user->profile_avatar_url))
            <img src="{{ asset(images/icons/odysee-logo.png) }}">
        @else
            <div class="user-avatar-alternative" style="background-color: {{ $comment->user->avatar_color }}"> {{ substr($comment->user->name, 0, 1) }} </div>
        @endif
        <div class="comment-wrapper">
            <div><strong> @if($comment->user->role == 0) Administrator @else {{ $comment->user->name }} @endif </strong></div>
            <span class="comment-timestamp"> {{ timeDiff($comment->created_at) }} </span>
            @if($comment->trashed())
                @if(Auth::check())
                    @if(Auth::user()->role == '0')
                        @if(strlen($comment->comment) < 200)
                            <p class="comment"> {{ $comment->comment }} </p>
                        @else
                            <p class="comment"> {{ character_limiter($comment->comment, 200) }} </p>
                            <strong class="expand-comment" data-comment="{{ $comment->comment }}"> See more </strong>
                        @endif
                        <p class="comment-deleted"> This comment has been deleted by an administrator. </p>
                    @else
                        <p class="comment comment-deleted"> This comment has been deleted by an administrator. </p>
                    @endif
                @else
                    <p class="comment comment-deleted"> This comment has been deleted by an administrator. </p>
                @endif
            @else
                @if(strlen($comment->comment) < 200)
                    <p class="comment"> {{ $comment->comment }} </p>
                @else
                    <p class="comment"> {{ character_limiter($comment->comment, 200) }} </p>
                    <strong class="expand-comment" data-comment="{{ $comment->comment }}"> See more </strong>
                @endif
            @endif
            <div class="comment-react" data-comment_id="{{ $comment->id }}">
                <a class="button-tertiary show-reply-form"><i class="fa-solid fa-reply"></i> Reply </a>
                <a href="#" class="button-tertiary comment-react-like"><i class="@if(count($comment->user_liked)) fa-solid @else fa-regular @endif fa-thumbs-up"></i><span> {{ count($comment->likes) }} </span></a>
                <a href="#" class="button-tertiary comment-react-dislike"><i class="@if(count($comment->user_disliked)) fa-solid @else fa-regular @endif fa-thumbs-down"></i><span> {{ count($comment->dislikes) }} </span></a>
                @if(Auth::check())
                    @if(Auth::user()->role == '0')
                        @if($comment->trashed())
                            <a href="#" class="button-tertiary comment-restore" title="Restore comment"><i class="fa-solid fa-trash-arrow-up"></i></a>
                        @else
                            <a href="#" class="button-tertiary comment-delete" title="Delete comment"><i class="fa-solid fa-trash"></i></a>
                        @endif
                    @endif
                @endif
            </div>
            <form class="comment-form" style="display: none;">
                @csrf
                <div class="form-group">
                    <textarea class="form-control comment" name="comment" placeholder="Reply to @if($comment->user->role == 0) Administrator @else {{ $comment->user->name }} @endif"></textarea>
                    <input type="hidden" name="article_id" value="{{ $article_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                    <input type="hidden" name="depth" value="{{ $comment->depth+1 }}" />
                </div>
                <div class="form-group btn-comment-wrapper">
                    <button type="submit" class="btn btn-gradient-primary"> Send </button>
                </div>
            </form>
            @if($comment->depth > 1)
                @if(count($comment->replies) > 1)
                    <a class="button-tertiary expand-entire-comment-list"><i class="fa-solid fa-comment"></i> {{ count($comment->replies) }} replies </a>
                @elseif(count($comment->replies) == 1)
                    <a class="button-tertiary expand-entire-comment-list"><i class="fa-solid fa-comment"></i> 1 reply </a>
                @endif
            @endif
            <div class="comment-list" data-comment_list_comment_id="{{ $comment->id }}" style="@if($comment->depth > 1) display:none; @endif">
                @include('user.comment.comment', ['comments' => $comment->replies])
            </div>
        </div>
    </div>
@endforeach
@if(count($comments) == 3)
    <a class="button-tertiary expand-comment-list"><i class="fa-solid fa-comment"></i> 1 relpy </a>
@elseif(count($comments) > 3)
    <a class="button-tertiary expand-comment-list"><i class="fa-solid fa-comment"></i> <span class="count-rest-comments"> {{ count($comments) - 3 }} </span> replies </a>
@endif
