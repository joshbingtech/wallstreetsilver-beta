@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="tradingview-widget-container ticker-tape-price">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                    {
                        "symbols": [
                            {
                                "description": "Silver",
                                "proName": "TVC:SILVER"
                            },
                            {
                                "description": "Gold",
                                "proName": "TVC:GOLD"
                            },
                            {
                                "description": "Gold/Silver",
                                "proName": "TVC:GOLDSILVER"
                            },
                            {
                                "description": "Platinum",
                                "proName": "TVC:PLATINUM"
                            },
                            {
                                "description": "Palladium",
                                "proName": "TVC:PALLADIUM"
                            }
                        ],
                        "showSymbolLogo": true,
                        "colorTheme": "dark",
                        "isTransparent": true,
                        "largeChartUrl": "https://sss",
                        "displayMode": "regular",
                        "locale": "en"
                    }
                </script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mt-3">
            <div class="price-chart-container mt-5">
                <div class="tradingview-widget-container">
                    <div id="tradingview_4cf27"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.MediumWidget(
                            {
                                "symbols": [
                                    [
                                        "Silver",
                                        "TVC:SILVER|1D"
                                    ]
                                ],
                                "chartOnly": false,
                                "width": "100%",
                                "height": 300,
                                "locale": "en",
                                "colorTheme": "dark",
                                "autosize": true,
                                "showVolume": true,
                                "hideDateRanges": false,
                                "hideMarketStatus": false,
                                "hideSymbolLogo": false,
                                "scalePosition": "right",
                                "scaleMode": "Normal",
                                "fontSize": "10",
                                "noTimeScale": false,
                                "valuesTracking": "1",
                                "changeMode": "price-and-percent",
                                "chartType": "line",
                                "gridLineColor": "rgba(255, 255, 255, 0.06)",
                                "timeHoursFormat": "12-hours",
                                "color": "#818C9B",
                                "lineWidth": 1,
                                "container_id": "tradingview_4cf27"
                            }
                        );
                    </script>
                </div>
            </div>
            <div class="price-chart-container">
                <div class="tradingview-widget-container">
                    <div id="tradingview_ce2f0"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.MediumWidget(
                            {
                                "symbols": [
                                    [
                                        "Gold",
                                        "TVC:GOLD|1D"
                                    ]
                                ],
                                "chartOnly": false,
                                "width": "100%",
                                "height": 300,
                                "locale": "en",
                                "colorTheme": "dark",
                                "autosize": true,
                                "showVolume": true,
                                "hideDateRanges": false,
                                "hideMarketStatus": false,
                                "hideSymbolLogo": false,
                                "scalePosition": "right",
                                "scaleMode": "Normal",
                                "fontSize": "10",
                                "noTimeScale": false,
                                "valuesTracking": "1",
                                "changeMode": "price-and-percent",
                                "chartType": "line",
                                "gridLineColor": "rgba(255, 255, 255, 0.06)",
                                "timeHoursFormat": "12-hours",
                                "color": "#F2B604",
                                "lineWidth": 1,
                                "container_id": "tradingview_ce2f0"
                            }
                        );
                    </script>
                </div>
            </div>
            <div class="price-chart-container">
                <div class="tradingview-widget-container">
                    <div id="tradingview_76426"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.MediumWidget(
                            {
                                "symbols": [
                                    [
                                        "Oil",
                                        "TVC:USOIL|1D"
                                    ]
                                ],
                                "chartOnly": false,
                                "width": "100%",
                                "height": 300,
                                "locale": "en",
                                "colorTheme": "dark",
                                "autosize": true,
                                "showVolume": true,
                                "hideDateRanges": false,
                                "hideMarketStatus": false,
                                "hideSymbolLogo": false,
                                "scalePosition": "right",
                                "scaleMode": "Normal",
                                "fontSize": "10",
                                "noTimeScale": false,
                                "valuesTracking": "1",
                                "changeMode": "price-and-percent",
                                "chartType": "line",
                                "gridLineColor": "rgba(255, 255, 255, 0.06)",
                                "timeHoursFormat": "12-hours",
                                "color": "#0085CC",
                                "lineWidth": 1,
                                "container_id": "tradingview_76426"
                            }
                        );
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <h2 class="text-center"> {{ $article->title }} </h2>
            <img id="article-thumbnail-preview" class="mt-3" src="{{ asset('articles/'.$article['thumbnail']) }}">
            <div id="article-content-preview" class="mt-3 ck-content"> {!! $article->description !!} </div>
            <h4>
                Conversation
                <span class="comments-count"> No Comments Yet </span>
                <span class="views-count"><img src="{{ asset('images/icons/view-count.png') }}"> {{ $article['views'] }}</span>
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
            <form class="comment-form comment-to-article">
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
            <div class="price-chart-container mt-5">
                <div class="tradingview-widget-container">
                    <div id="tradingview_2f928"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.MediumWidget(
                            {
                                "symbols": [
                                    [
                                        "Gold/Silver",
                                        "TVC:GOLDSILVER|1D"
                                    ]
                                ],
                                "chartOnly": false,
                                "width": "100%",
                                "height": 300,
                                "locale": "en",
                                "colorTheme": "dark",
                                "autosize": true,
                                "showVolume": true,
                                "hideDateRanges": false,
                                "hideMarketStatus": false,
                                "hideSymbolLogo": false,
                                "scalePosition": "right",
                                "scaleMode": "Normal",
                                "fontSize": "10",
                                "noTimeScale": false,
                                "valuesTracking": "1",
                                "changeMode": "price-and-percent",
                                "chartType": "line",
                                "gridLineColor": "rgba(255, 255, 255, 0.06)",
                                "timeHoursFormat": "12-hours",
                                "color": "#33BF8C",
                                "lineWidth": 1,
                                "container_id": "tradingview_2f928"
                            }
                        );
                    </script>
                </div>
                <h6 class="text-center"> Gold Silver Ratio </h6>
            </div>
            <div class="embed-youtube">
                <iframe width="100%" height="auto" src="{{ 'https://www.youtube.com/embed/'.$youtube_video_id }}"></iframe>
            </div>
        </div>
    </div>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-form text-left">
                        <img class="banner mb-3" src="{{ asset('images/logo.png') }}" />
                        <h4> We just like Silver. </h4>
                        <h6 class="font-weight-light"> Sign in to continue. </h6>
                        <form class="pt-3" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg auth-form-btn"> SIGN IN </button>
                            </div>
                            <div class="text-center mt-4">
                                Don't have an account? <a href="{{ route('register') }}" class="button-secondary"> Sign Up </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                        $(this).html('<i class="fa-solid fa-comment"></i> 1 reply');
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
                            if(errors == "Unauthorised user.") {
                                $("#loginModal").modal("show");
                            } else {
                                $.each(errors, function(key, error) {
                                    if(key == "comment") {
                                        $(target_form).find(".comment").addClass("is-invalid");
                                        $(target_form).find(".comment").after('<span class="invalid-feedback" role="alert"><strong>' + error + '</strong></span>');
                                    }
                                });
                            }
                        }
                    }
                });
            });

            $(document).on("click", ".comment-react-like", function(e) {
                e.preventDefault();
                var that = this;
                var comment_id = $(this).parent().data("comment_id");
                $.ajax({
                    url: "{{ route('comment-like') }}",
                    type: 'POST',
                    data: {
                        comment_id: comment_id
                    },
                    success: function (response) {
                        var like_count = parseInt($($(that).find("span")[0]).html());
                        if(response.status) {
                            if(response.action == "like") {
                                $(that).html('<i class="fa-solid fa-thumbs-up"></i><span> ' + (like_count + 1).toString() + ' </span>');
                            } else if(response.action == "delete") {
                                $(that).html('<i class="fa-regular fa-thumbs-up"></i><span> ' + (like_count - 1).toString() + ' </span>');
                            }
                        } else {
                            var errors = response.message;
                            if(errors == "Unauthorised user.") {
                                $("#loginModal").modal("show");
                            }
                        }
                    }
                });
            });

            $(document).on("click", ".comment-react-dislike", function(e) {
                e.preventDefault();
                var that = this;
                var comment_id = $(this).parent().data("comment_id");
                $.ajax({
                    url: "{{ route('comment-dislike') }}",
                    type: 'POST',
                    data: {
                        comment_id: comment_id
                    },
                    success: function (response) {
                        var dislike_count = parseInt($($(that).find("span")[0]).html());
                        if(response.status) {
                            if(response.action == "dislike") {
                                $(that).html('<i class="fa-solid fa-thumbs-down"></i><span> ' + (dislike_count + 1).toString() + ' </span>');
                            } else if(response.action == "delete") {
                                $(that).html('<i class="fa-regular fa-thumbs-down"></i><span> ' + (dislike_count - 1).toString() + ' </span>');
                            }
                        } else {
                            var errors = response.message;
                            if(errors == "Unauthorised user.") {
                                $("#loginModal").modal("show");
                            }
                        }
                    }
                });
            });

            $(document).on("click", ".comment-delete", function(e) {
                e.preventDefault();
                var that = this;
                var comment_id = $(this).parent().data("comment_id");
                $.ajax({
                    url: "{{ route('admin/delete-comment') }}",
                    type: 'POST',
                    data: {
                        comment_id: comment_id
                    },
                    success: function (response) {
                        if(response.status) {
                            if(response.action == "delete") {
                                location.reload();
                            }
                        } else {
                            var errors = response.message;
                            if(errors == "Unauthorised user.") {
                                $("#loginModal").modal("show");
                            } else {
                                location.reload();
                            }
                        }
                    }
                });
            });

            $(document).on("click", ".comment-restore", function(e) {
                e.preventDefault();
                var that = this;
                var comment_id = $(this).parent().data("comment_id");
                $.ajax({
                    url: "{{ route('admin/restore-comment') }}",
                    type: 'POST',
                    data: {
                        comment_id: comment_id
                    },
                    success: function (response) {
                        if(response.status) {
                            if(response.action == "restore") {
                                location.reload();
                            }
                        } else {
                            var errors = response.message;
                            if(errors == "Unauthorised user.") {
                                $("#loginModal").modal("show");
                            } else {
                                location.reload();
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush