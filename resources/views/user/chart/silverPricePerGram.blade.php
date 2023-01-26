@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                            {
                                "symbol": "FX_IDC:XAGUSDG",
                                "width": "100%",
                                "height": "100%",
                                "locale": "en",
                                "colorTheme": "dark",
                                "isTransparent": true
                            }
                        </script>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                            {
                                "symbol": "FX_IDC:XAUUSDG",
                                "width": "100%",
                                "height": "100%",
                                "locale": "en",
                                "colorTheme": "dark",
                                "isTransparent": true
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="tradingview-widget-container">
                    <div id="tradingview_918f1"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.widget(
                            {
                                "width": "100%",
                                "height": 610,
                                "symbol": "FX_IDC:XAGUSDG",
                                "timezone": "America/New_York",
                                "theme": "dark",
                                "style": "2",
                                "locale": "en",
                                "toolbar_bg": "#f1f3f6",
                                "enable_publishing": false,
                                "withdateranges": true,
                                "range": "1D",
                                "hide_side_toolbar": false,
                                "save_image": false,
                                "container_id": "tradingview_918f1"
                            }
                        );
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
@endsection
@push("scripts")

@endpush
