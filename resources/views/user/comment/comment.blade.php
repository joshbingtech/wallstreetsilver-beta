@foreach($comments as $key => $comment)
    <div class="comment-item" style="@if($key > 2) display:none; @endif">
        @if(isset($comment->user->profile_avatar_url) && !empty($comment->user->profile_avatar_url))
            <img src="{{ asset(images/icons/odysee-logo.png) }}">
        @else
            <div class="user-avatar-alternative" style="background-color: {{ $comment->user->avatar_color }}"> {{ substr($comment->user->name, 0, 1) }} </div>
        @endif
        <div class="comment-wrapper">
            <div><strong> {{ $comment->user->name }} </strong></div>
            <span class="comment-timestamp"> {{ timeDiff($comment->created_at) }} </span>
            @if(strlen($comment->comment) < 200)
                <p class="comment"> {{ $comment->comment }} </p>
            @else
                <p class="comment"> {{ character_limiter($comment->comment, 200) }} </p>
                <strong class="expand-comment" data-comment="{{ $comment->comment }}"> See more </strong>
            @endif
            <div class="comment-react" data-comment_id="{{ $comment->id }}">
                <a class="button-tertiary show-reply-form"> Reply </a>
                <a href="#" class="button-tertiary comment-react-like"><i class="ti-thumb-up"></i> {{ count($comment->likes) }} </a>
                <a href="#" class="button-tertiary comment-react-dislike"><i class="ti-thumb-down"></i> {{ count($comment->dislikes) }} </a>
            </div>
            <form class="comment-form" method="post" action="{{ route('comment') }}" style="display: none;">
                @csrf
                <div class="form-group">
                    <textarea class="form-control comment" name="comment" placeholder="Reply to {{ $comment->user->name }}"></textarea>
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
                    <a class="button-tertiary expand-entire-comment-list"><i class="ti-hand-point-right"></i> {{ count($comment->replies) }} replies </a>
                @elseif(count($comment->replies) == 1)
                    <a class="button-tertiary expand-entire-comment-list"><i class="ti-hand-point-right"></i> 1 reply </a>
                @endif
            @endif
            <div class="comment-list" data-comment_list_comment_id="{{ $comment->id }}" style="@if($comment->depth > 1) display:none; @endif">
                @include('user.comment.comment', ['comments' => $comment->replies])
            </div>
        </div>
    </div>
@endforeach
@if(count($comments) == 3)
    <a class="button-tertiary expand-comment-list"><i class="ti-hand-point-right"></i> 1 relpy </a>
@elseif(count($comments) > 3)
    <a class="button-tertiary expand-comment-list"><i class="ti-hand-point-right"></i> <span class="count-rest-comments"> {{ count($comments) - 3 }} </span> replies </a>
@endif
