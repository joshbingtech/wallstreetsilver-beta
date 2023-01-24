<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $supporters = array(
            array("src" => "images/supporters/AbraSilver.png", "url" => "https://test.com"),
            array("src" => "images/supporters/DollyVarden.png", "url" => "https://test.com"),
            array("src" => "images/supporters/Eloro.png", "url" => "https://test.com"),
            array("src" => "images/supporters/Kinesis.png", "url" => "https://test.com"),
            array("src" => "images/supporters/KuyaSilver.png", "url" => "https://test.com"),
            array("src" => "images/supporters/SilverGoldBull.png", "url" => "https://test.com"),
            array("src" => "images/supporters/SprottMoney.png", "url" => "https://test.com"),
        );
        $contacts = array(
            array("name" => "Jim Lewis", "thumbnail" => "images/avatars/Jim.png", "contact_link" => "https://www.linkedin.com/in/wallstreetsilver/"),
            array("name" => "Ivan Bayoukhi", "thumbnail" => "images/avatars/Ivan.png", "contact_link" => "https://www.linkedin.com/in/ivanbayoukhi/"),
        );
        $social_links = array(
            "twitter" => "https://twitter.com/WallStreetSilv",
            "youtube" => "https://www.youtube.com/c/WallStreetSilverOfficial",
            "reddit" => "https://www.reddit.com/r/Wallstreetsilver",
            "discord" => "https://discord.com/invite/JPHFPBNNqg",
            "instagram" => "https://www.instagram.com/wallstreetsilver",
            "linkedin" => "https://www.linkedin.com/in/wallstreetsilver",
            "facebook" => "https://www.facebook.com/Wall-Street-Silver-103206701843254",
            //"podbeen" => "https://wallstreetsilverofficial.podbean.com",
            "rumble" => "https://rumble.com/c/WallStreetSilver",
            "odysee" => "https://odysee.com/@WallStreetSilver:e",
            "gab" => "https://gab.com/WallStreetSilverOfficial",
            "telegram" => "https://t.me/WallStreetSilver",
        );
        $current_nav_tab = '';
        View::share('supporters', $supporters);
        View::share('contacts', $contacts);
        View::share('social_links', $social_links);
        View::share('current_nav_tab', $current_nav_tab);

        Paginator::useBootstrap();
    }
}
