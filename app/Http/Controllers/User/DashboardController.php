<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Twitter;

class DashboardController extends Controller
{
    public function index()
    {
        $article = new Article;
        $params = [
            'tweet.fields' => 'text,created_at,id',
            'expansions' => 'author_id',
            'user.fields' => 'username'
        ];

        $tweets = array();
        $json = Twitter::userTweets('1366565625401909249', $params);
        $array = json_decode($json, true);
        $author = $array['includes']['users'][0]['username'];
        $tweets_array = $array['data'];
        foreach ($tweets_array as $value) {
            array_push($tweets, array(
                'text' => $value['text'],
                'created_at' => $value['text'],
                'tweet_url' => "https://twitter.com/".$author."/status/".$value['id'],
                'author_url' => "https://twitter.com/".$author,
                'author' => $author
            ));
        }

        $data = [
            'tweets' => $tweets,
            'featured_articles' => $article->getFeaturedArticles(),
            'articles_for_carousel' => $article->getArticlesForCarousel(),
        ];
        return view('user/dashboard', $data);
    }
}
