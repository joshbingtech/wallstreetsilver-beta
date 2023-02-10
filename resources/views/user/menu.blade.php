<ul class="navbar-nav me-auto">
    <li class="nav-item nav-item-empty"></li>
    <div>
        @foreach ($social_links as $social_link)
            <a class="social-link" href="{{ $social_link['url'] }}" target="_blank" title={{ ucfirst(strtolower($social_link['service'])) }}>
                @if (file_exists(public_path('images/icons/'.strtolower($social_link['service']).'-logo.png')))
                    <img src="{{ asset('images/icons/'.strtolower($social_link['service']).'-logo.png') }}">
                @else
                    {{ ucfirst(strtolower($social_link['service'])) }}
                @endif
            </a>
        @endforeach
    </div>
</ul>
<ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link @if ($current_nav_tab == "home") nav-link-active @endif"> Home </a>
    </li>
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
                            <img src="{{ asset('images/images/small-gold-bar-1.png') }}"> Gold
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
                            <img src="{{ asset('images/images/small-silver-bar-1.png') }}"> Silver
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
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="h3">
                            <img src="{{ asset('images/images/small-silver-bar-1.png') }}"> Platinum
                        </div>
                        <div><a class="dropdown-item" href="{{ route('charts/live-platinum-price') }}"> Live Platinum Price </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/platinum-price-per-ounce') }}"> Platinum Price Per Ounce </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/platinum-price-per-gram') }}"> Platinum Price Per Gram </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/platinum-price-per-kilo') }}"> Platinum Price Per Kilo </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/platinum-price-history') }}"> Platinum Price History </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/gold-platinum-ratio') }}"> Gold Platinum Ratio </a></div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="h3">
                            <img src="{{ asset('images/images/small-silver-bar-1.png') }}"> Palladium
                        </div>
                        <div><a class="dropdown-item" href="{{ route('charts/live-palladium-price') }}"> Live Palladium Price </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/palladium-price-per-ounce') }}"> Palladium Price Per Ounce </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/palladium-price-per-gram') }}"> Palladium Price Per Gram </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/palladium-price-per-kilo') }}"> Palladium Price Per Kilo </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/palladium-price-history') }}"> Palladium Price History </a></div>
                        <div><a class="dropdown-item" href="{{ route('charts/gold-palladium-ratio') }}"> Gold Palladium Ratio </a></div>
                    </div>
                </div>
            </div>
        </div>
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
