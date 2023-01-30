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
                <span class="comments-count"> No Comments Yet </span>
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
            <form class="comment-form comment-to-article" method="post" action="{{ route('comment') }}">
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
        function getTotalNumberOfComments() {
            var comment_count = $('.comment-item').length;
            if(comment_count == 1) {
                $(".comments-count").text("1 comment");
            } else if(comment_count > 1) {
                $(".comments-count").text(comment_count + " comments");
            }
        }
        $(document).ready(() => {
            getTotalNumberOfComments();

            $(document).on("click", ".show-reply-form", function() {
                $(this).parent().next("form").fadeIn();
            });

            $(document).on("click", ".expand-comment", function() {
                var comment = $(this).data("comment");
                $(this).prev().text(comment);
                $(this).remove();
            });
            
            $(document).on("click", ".expand-entire-comment-list", function() {
                $(this).next(".comment-list").fadeIn();
                $(this).remove();
            });

            $(document).on("click", ".expand-comment-list", function() {
                var hidden_comments = $(this).siblings(".comment-item:hidden");
                
                if(hidden_comments.length > 3) {
                    hidden_comments = hidden_comments.slice(0, 3);
                    var count_rest_comments = parseInt($($(this).find(".count-rest-comments")[0]).text()) - 3;
                    if(count_rest_comments > 1) {
                        $($(this).find(".count-rest-comments")[0]).text(count_rest_comments);
                    } else if(count_rest_comments == 1) {
                        $(this).html('<i class="ti-hand-point-right"></i> 1 reply');
                    }
                } else {
                    $(this).remove();
                }
                $(hidden_comments).each(function() {
                    $(this).fadeIn();
                });
            });

            $(document).on("submit", ".comment-form", function(e) {
                e.preventDefault();
                var target_form = this;
                
                $(target_form).find(".comment").removeClass("is-invalid");
                $(target_form).find(".comment").next().remove("span");

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

                            if(!$(target_form).hasClass('comment-to-article')) {
                                $(target_form).hide();
                                $(target_form).next(".expand-entire-comment-list").remove();
                                $(".comment-list[data-comment_list_comment_id='"+parent_id+"']").fadeIn();
                            }

                            getTotalNumberOfComments();
                        } else {
                            var errors = response.message;
                            $.each(errors, function(key, error) {
                                if(key == "comment") {
                                    $(target_form).find(".comment").addClass("is-invalid");
                                    $(target_form).find(".comment").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                }
                            });
                        }
                    }
                });
            });

            $(document).on("click", ".comment-react-like", function() {
                
            });

            $(document).on("click", ".comment-react-dislike", function() {
                
            });
        });
    </script>
@endpush