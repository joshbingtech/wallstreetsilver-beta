<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Twitter;
use Alaouy\Youtube\Facades\Youtube;

class DashboardController extends Controller
{
    public function index()
    {

        $videoList = Youtube::listChannelVideos('UCXWoMTRWJTIZwUblljo5aDQ', 1, 'date');
        $youtube_latest_video_id = $videoList[0]->id->videoId;

        $article = new Article;

        $params = [
            'exclude' => 'retweets,replies',
            'tweet.fields' => 'text,created_at,id',
            'expansions' => 'author_id',
            'user.fields' => 'username',
            'max_results' => 5
        ];

        $tweets = array();
        $json = Twitter::userTweets('1366565625401909249', $params);
        $array = json_decode($json, true);
        $author = $array['includes']['users'][0]['username'];
        $tweets_array = array_slice($array['data'], 0, 3);
        foreach ($tweets_array as $value) {
            array_push($tweets, array(
                'text' => $value['text'],
                'created_at' => $value['created_at'],
                'tweet_url' => "https://twitter.com/".$author."/status/".$value['id'],
                'author_url' => "https://twitter.com/".$author,
                'author' => $author
            ));
        }

        $data = [
            'tweets' => $tweets,
            'articles' => $article->getArticles(),
            'articles_for_carousel' => $article->getArticlesForCarousel(),
            'youtube_video_id' => $youtube_latest_video_id,
        ];
        return view('user/dashboard', $data);
    }
}
