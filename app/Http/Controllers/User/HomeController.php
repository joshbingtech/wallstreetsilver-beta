<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Twitter;
use Alaouy\Youtube\Facades\Youtube;

class HomeController extends Controller
{
    public function index()
    {

        $videoList = Youtube::listChannelVideos('UCXWoMTRWJTIZwUblljo5aDQ', 1, 'date');
        $youtube_latest_video_id = $videoList[0]->id->videoId;

        $article = new Article;

        $params = [
            'tweet.fields' => 'text,created_at,id,attachments',
            'expansions' => 'author_id,attachments.media_keys',
            'media.fields' => 'alt_text,url,preview_image_url,variants',
            'user.fields' => 'username',
            'exclude' => 'retweets,replies',
            'max_results' => 5,
        ];

        $tweets = array();
        $json = Twitter::userTweets('1366565625401909249', $params);
        $array = json_decode($json, true);
        $tweets_array = $array['data'];
        $tweets_array = array_slice($array['data'], 0, 3);
        $author = $array['includes']['users'][0]['username'];
        if(isset($array['includes']['media'])) {
            $media_array = $array['includes']['media'];
        }
        
        foreach ($tweets_array as $value) {
            if(isset($value['attachments'])) {
                $temp_media_array = array();
                $media_keys = $value['attachments']['media_keys'];
                foreach($media_keys as $media_key) {
                    $key = array_search($media_key, array_column($media_array, 'media_key'));
                    if($media_array[$key]['type'] == 'photo') {
                        array_push($temp_media_array, array(
                            'type' => 'photo',
                            'url' => $media_array[$key]['url']
                        ));
                    } else if($media_array[$key]['type'] == 'video') {
                        array_push($temp_media_array, array(
                            'type' => 'video',
                            'url' => $media_array[$key]['variants'][0]['url']
                        ));
                    }
                }
                array_push($tweets, array(
                    'text' => $value['text'],
                    'created_at' => $value['created_at'],
                    'tweet_url' => "https://twitter.com/".$author."/status/".$value['id'],
                    'author_url' => "https://twitter.com/".$author,
                    'author' => $author,
                    'media_array' => $temp_media_array
                ));
            } else {
                array_push($tweets, array(
                    'text' => $value['text'],
                    'created_at' => $value['created_at'],
                    'tweet_url' => "https://twitter.com/".$author."/status/".$value['id'],
                    'author_url' => "https://twitter.com/".$author,
                    'author' => $author,
                ));
            }
        }
        $data = [
            'tweets' => $tweets,
            'articles' => $article->getArticles(),
            'articles_for_carousel' => $article->getArticlesForCarousel(),
            'youtube_video_id' => $youtube_latest_video_id,
            'current_nav_tab' => 'home',
        ];
        return view('user/home', $data);
    }
}
