@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 mt-3">
        </div>
        <div class="col-md-6 mt-3">
            <h2 class="text-center mt-3"> {{ $article->title }} </h2>
            <img id="article-thumbnail-preview" class="mt-3" src="{{ asset('articles/'.$article['thumbnail']) }}">
            <div id="article-content-preview" class="mt-3 ck-content"> {!! $article->description !!} </div>
            <h4>
                Conversation
                @if(count($article->comments) == 0)
                    <span class="comments-count" data-comments_count="{{ count($article->comments) }}"> No Comments Yet </span>
                @elseif(count($article->comments) == 1)
                    <span class="comments-count" data-comments_count="{{ count($article->comments) }}"> 1 Comment </span>
                @else
                    <span class="comments-count" data-comments_count="{{ count($article->comments) }}">{{ count($article->comments) }} Comments</span>
                @endif
            </h4>
            @if(count($article->comments) > 0)
                <hr />
            @endif            
            <div class="conversation-section">
                <div class="comment-list">
                    @include('user.comment.comment', ['comments' => $article->comments, 'article_id' => $article->id])
                </div>
            </div>
            <hr />
            <form class="comment-form" method="post" action="{{ route('comment') }}">
                @csrf
                <div class="form-group">
                    <textarea class="form-control comment" name="comment" placeholder="@if(count($article->comments) == 0) Be the first to comment... @else What do you think?  @endif"></textarea>
                    <input type="hidden" name="article_id" value="{{ $article->id }}" />
                    <input type="hidden" name="depth" value="1" />
                </div>
                <div class="form-group btn-comment-wrapper">
                    <button type="submit" class="btn btn-gradient-primary"> Add Comment </button>
                </div>
            </form>
        </div>
        <div class="col-md-3 mt-3">
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(() => {
            $(document).on("click", ".show-reply-form", function() {
                $(this).parent().next("form").fadeIn();
            });

            $(document).on("click", ".expand-comment", function() {
                var comment = $(this).data("comment");
                $(this).prev().text(comment);
                $(this).remove();
            });
            $(document).on("click", ".expand-comment-list", function() {
                $(this).next(".comment-list").fadeIn();
                $(this).remove();
            });

            $(document).on("submit", ".comment-form", function(e) {
                e.preventDefault();
                var target_form = this;
                
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('comment') }}",
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status) {
                            var parent_id = $("input[name='parent_id']", target_form).val();
                            var html = response.html;
                            if(typeof parent_id === "undefined") {
                                $(".conversation-section>.comment-list").append(html);
                            } else {
                                $(".comment-list[data-comment_list_comment_id='"+parent_id+"']").append(html);
                            }
                            $("textarea[name='comment']", target_form).val('');
                            $(target_form).hide();
                            $(target_form).next(".expand-comment-list").remove();
                            $(".comment-list[data-comment_list_comment_id='"+parent_id+"']").fadeIn();
                        } else {
                            var errors = response.error;
                            $.each(errors, function(key, error) {
                                if(key == "article-thumbnail") {
                                    $("#upload-article-thumbnail-btn").addClass("is-invalid");
                                    $("#upload-article-thumbnail-btn").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                } else if(key == "article-title") {
                                    $("#article-title").addClass("is-invalid");
                                    $("#article-title").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                } else if(key == "article") {
                                    $("#article-editor").addClass("is-invalid");
                                    $(".ck.ck-reset.ck-editor.ck-rounded-corners").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush