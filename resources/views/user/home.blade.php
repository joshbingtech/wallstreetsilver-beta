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
                                    <a href="{{ route('display-article', base64_encode($article['id'])) }}" class="article-link">
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
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
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
            <div class="price-chart-container">
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
            <div class="tweets">
                <table class="flow-full-table" style="width: 100%;">
                    <tbody>
                        @foreach ($tweets as $tweet)
                        <tr>
                            <td>
                                <a href = "{{ $tweet['author_url'] }}"> <img src="{{ asset('images/icons/twitter-logo.png') }}"> </a>
                            </td>
                            <td>
                                <div class="news">
                                    <a class="news-text" href="{{ $tweet['tweet_url'] }}" target="_blank">
                                        {{ $tweet['text'] }}
                                        @if(isset($tweet['media_array']))
                                            @foreach ($tweet['media_array'] as $media)
                                                @if($media['type'] == 'video')
                                                    <video class="twitter-media" src="{{ $media['url'] }}" controls></video>
                                                @elseif($media['type'] == 'photo')
                                                    <img class="twitter-media" src="{{ $media['url'] }}">
                                                @endif
                                            @endforeach
                                        @endif
                                        <div class="created_at"> {{ convertDateTimeToTime($tweet['created_at']) }} </div>
                                        
                                    </a>
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