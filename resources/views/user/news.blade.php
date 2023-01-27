@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 mt-3">
        </div>
        <div class="col-md-6 mt-3">
            <div class="container mt-5">
                <div class="featured-articles">
                    @foreach ($articles as $article)
                        <a href="{{ route('display-article', base64_encode($article['id'])) }}" class="article-link">
                            <div class="row article border-white">
                                <div class="col-md-3">
                                    <div class="outer">
                                        <div class="middle">
                                            <div>
                                                <img src="{{ asset('articles/'.$article['thumbnail']) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 article-summary">
                                    <h4 class="text-center"> {{ $article['title'] }} </h4>
                                    <div>
                                        {{ character_limiter($article['description'], 200) }}
                                    </div>
                                    <div class="article-publish-date">
                                        {{ convertDateTimeToDate($article['created_at']) }}
                                    </div>
                                    <div class="article-view">
                                        <img src="{{ asset('images/icons/view-count.png') }}"> {{ $article['views'] }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-3">
        </div>
    </div>
</div>
@endsection