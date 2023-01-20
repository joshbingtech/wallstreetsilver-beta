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
            <div class="price-chart-container">
                {{-- <img class="price-chart" src="https://goldprice.org/charts/silver_1d_o_USD_z.png"> --}}
                <div class="tradingview-widget-container mini-chart">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                        {
                            "symbol": "TVC:SILVER",
                            "width": "100%",
                            "height": "100%",
                            "locale": "en",
                            "dateRange": "1D",
                            "colorTheme": "dark",
                            "trendLineColor": "#10a9fb",
                            "isTransparent": true,
                            "autosize": true,
                            "largeChartUrl": "https://tradingview.com",
                            "chartOnly": false
                        }
                    </script>
                </div>
                <h6 class="text-center"> 1 Day Silver Price per Ounce </h6>
            </div>
            <div class="price-chart-container">
                {{-- <img class="price-chart" src="https://goldprice.org/charts/gold_1d_o_USD_z.png"> --}}
                <div class="tradingview-widget-container mini-chart">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                        {
                            "symbol": "TVC:GOLD",
                            "width": "100%",
                            "height": "100%",
                            "locale": "en",
                            "dateRange": "1D",
                            "colorTheme": "dark",
                            "trendLineColor": "#F95360",
                            "isTransparent": true,
                            "autosize": true,
                            "largeChartUrl": "https://tradingview.com",
                            "chartOnly": false
                        }
                    </script>
                </div>
                <h6 class="text-center"> 1 Day Gold Price per Ounce </h6>
            </div>
            <div class="price-chart-container">
                {{-- <img class="price-chart" src="https://goldprice.org/charts/history/gold_30_day_silver_x.png"> --}}
                <div class="tradingview-widget-container mini-chart">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                        {
                            "symbol": "TVC:GOLDSILVER",
                            "width": "100%",
                            "height": "100%",
                            "locale": "en",
                            "dateRange": "1D",
                            "colorTheme": "dark",
                            "trendLineColor": "rgb(106, 168, 79)",
                            "isTransparent": true,
                            "autosize": true,
                            "largeChartUrl": "https://tradingview.com",
                            "chartOnly": false
                        }
                    </script>
                </div>
                <h6 class="text-center"> Gold Silver Ratio </h6>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            @if ($articles_for_carousel->count() > 0)
                <div class="featured-story-carousel border-white">
                    <div id="featured-story-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($articles_for_carousel as $key => $article)
                            <button type="button" data-bs-target="#featured-story-carousel" data-bs-slide-to="{{ $key }}" class="@if ($key == 0) active @endif" aria-current="true" aria-label="Slide {{ $key }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($articles_for_carousel as $key => $article)
                                <div class="carousel-item @if ($key == 0) active @endif" data-bs-interval="5000">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="outer">
                                                <div class="middle">
                                                    <div>
                                                        <img src="{{ asset('articles/'.$article['thumbnail']) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8" style="min-height: 210px; position: relative;">
                                            <h3 class="text-center"> {{ $article['title'] }} </h3>
                                            <div>
                                                {{ character_limiter($article['description'], 200) }}
                                                <a href="#"> Continue Reading </a>
                                            </div>
                                            <div class="article-publish-date">
                                                <div>
                                                    {{ convertDateTimeToDate($article['created_at']) }}
                                                </div>
                                                <div class="article-view">
                                                    <img src="{{ asset('images/icons/view-count.png') }}"> {{ $article['views'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="container mt-5">
                <div class="featured-articles">
                    @foreach ($articles as $article)
                        <a href="#" class="article-link">
                            <div class="row article border-white">
                                <div class="col-md-4">
                                    <div class="outer">
                                        <div class="middle">
                                            <div>
                                                <img src="{{ asset('articles/'.$article['thumbnail']) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 article-summary">
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
            <div class="embed-youtube">
                <iframe width="100%" height="auto" src="https://www.youtube.com/embed/3YWA2calTgQ"></iframe>
            </div>
            <div class="tweets">
                <table class="flow-full-table" style="width: 100%;">
                    <tbody>
                        @foreach ($tweets as $tweet)
                        <tr>
                            <td>
                                {{ convertDateTimeToDateTime($tweet['created_at']) }}
                            </td>
                            <td>
                                <div class="news">
                                    <a href = "{{ $tweet['author_url'] }}"> {{ "@".$tweet['author'].": " }} </a>
                                    <a class="news-text" href = "{{ $tweet['tweet_url'] }}"> {{ $tweet['text'] }} </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push("scripts")
    <script>

    </script>
@endpush
