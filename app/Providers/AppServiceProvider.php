<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\SocialMedia;
use App\Models\Supporter;

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
        $supporters = Supporter::all();
        if(!count($supporters)) {
            $supporters = array(
                array("src" => "images/supporters/AbraSilver.png", "url" => "https://www.abrasilver.com/news-releases/"),
                array("src" => "images/supporters/DollyVarden.png", "url" => "https://dollyvardensilver.com/news/"),
                array("src" => "images/supporters/Eloro.png", "url" => "https://www.elororesources.com/en/news-media/news/"),
                array("src" => "images/supporters/Kinesis.png", "url" => "https://kms.kinesis.money/signup?referrer=KM13492686"),
                array("src" => "images/supporters/KuyaSilver.png", "url" => "https://kuyasilver.com/news"),
                array("src" => "images/supporters/SilverGoldBull.png", "url" => "https://silvergoldbull.com/ape"),
                array("src" => "images/supporters/SprottMoney.png", "url" => "https://www.sprottmoney.com/bullion?utm_source=WallStreetSilver&amp;utm_medium=Supporters&amp;utm_campaign=WebsiteReferral"),
            );
        }
        
        $contacts = array(
            array("name" => "Ivan Bayoukhi", "thumbnail" => "images/avatars/Ivan.png", "contact_link" => "https://www.linkedin.com/in/ivanbayoukhi/"),
        );
        
        $social_links = SocialMedia::all();
        if(!count($social_links)) {
            $social_links = array(
                array("service" => "twitter", "url" => "https://twitter.com/WallStreetSilv"),
                array("service" => "youtube", "url" => "https://www.youtube.com/c/WallStreetSilverOfficial"),
                array("service" => "reddit", "url" => "https://www.reddit.com/r/Wallstreetsilver"),
                array("service" => "discord", "url" => "https://discord.com/invite/JPHFPBNNqg"),
                array("service" => "instagram", "url" => "https://www.instagram.com/wallstreetsilver"),
                array("service" => "facebook", "url" => "https://www.facebook.com/Wall-Street-Silver-103206701843254"),
                array("service" => "podbean", "url" => "https://wallstreetsilverofficial.podbean.com"),
                array("service" => "rumble", "url" => "https://rumble.com/c/WallStreetSilver"),
                array("service" => "odysee", "url" => "https://odysee.com/@WallStreetSilver:e"),
                array("service" => "gab", "url" => "https://gab.com/WallStreetSilverOfficial"),
                array("service" => "telegram", "url" => "https://t.me/WallStreetSilver"),
            );
        }
        
        $current_nav_tab = '';
        View::share('supporters_for_carousel', $supporters);
        View::share('contacts', $contacts);
        View::share('social_links', $social_links);
        View::share('current_nav_tab', $current_nav_tab);

        Paginator::useBootstrap();
    }
}
