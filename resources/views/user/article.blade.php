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
        </div>
        <div class="col-md-3 mt-3">
        </div>
    </div>
</div>
@endsection