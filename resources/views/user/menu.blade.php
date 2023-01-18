<ul class="navbar-nav me-auto">
    <li class="nav-item nav-item-empty"></li>
    <div>
        <a class="social-link" href="https://twitter.com" target="_blank"><img src="{{ asset('images/icons/twitter-logo.png') }}"></a>
        <a class="social-link" href="https://youtube.com" target="_blank"><img src="{{ asset('images/icons/youtube-logo.png') }}"></a>
        <a class="social-link" href="https://reddit.com" target="_blank"><img src="{{ asset('images/icons/reddit-logo.png') }}"></a>
        <a class="social-link" href="https://discord.com" target="_blank"><img src="{{ asset('images/icons/discord-logo.png') }}"></a>
        <a class="social-link" href="https://instagram.com" target="_blank"><img src="{{ asset('images/icons/instagram-logo.png') }}"></a>
    </div>
</ul>
<ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a href="{{ route('news') }}" class="nav-link @if ($current_nav_tab == "news") nav-link-active @endif"> News </a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle @if ($current_nav_tab == "charts") nav-link-active @endif" role="button" data-bs-toggle="dropdown"> Charts </a>
        <div class="dropdown-menu">
            <div class="charts-dropdown">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="h3">
                            <img src="{{ asset('images/images/small-gold-bar-1.png') }}"> Gold Price Charts
                        </div>
                        <div><a class="dropdown-item" href="{{ route('charts/spot-gold') }}"> Spot Gold </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/live-gold-price') }}"> Live Gold Price </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/gold-price-per-ounce') }}"> Gold Price Per Ounce </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/gold-price-per-gram') }}"> Gold Price Per Gram </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/gold-price-per-kilo') }}"> Gold Price Per Kilo </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/gold-price-history') }}"> Gold Price History </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/gold-silver-ratio') }}"> Gold Silver Ratio </a></div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="h3">
                            <img src="{{ asset('images/images/small-silver-bar-1.png') }}"> Silver Price Charts
                        </div>
                        <div><a class="dropdown-item" href="{{ route('charts/spot-silver') }}"> Spot Silver </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/live-silver-price') }}"> Live Silver Price </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/silver-price-per-ounce') }}"> Silver Price Per Ounce </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/silver-price-per-gram') }}"> Silver Price Per Gram </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/silver-price-per-kilo') }}"> Silver Price Per Kilo </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/silver-price-history') }}"> Silver Price History </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/silver-gold-ratio') }}"> Silver Gold Ratio </a></div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link"> MERCH </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link"> ABOUT </a>
    </li>
    <li class="nav-item nav-item-empty"></li>
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Sign In') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
