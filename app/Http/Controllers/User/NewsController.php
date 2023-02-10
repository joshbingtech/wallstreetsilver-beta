<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Alaouy\Youtube\Facades\Youtube;

class NewsController extends Controller
{
    public function index()
    {
        $videoList = Youtube::listChannelVideos('UCXWoMTRWJTIZwUblljo5aDQ', 1, 'date');
        $youtube_latest_video_id = $videoList[0]->id->videoId;

        $article = new Article;

        $data = [
            'articles' => $article->getArticles(),
            'youtube_video_id' => $youtube_latest_video_id,
            'current_nav_tab' => 'news',
        ];
        return view('user/news', $data);
    }

    public function displayArticle($article_id)
    {
        $article_id = base64_decode($article_id);
        $article = Article::where('id', $article_id)
                    ->update(['views' => DB::raw('views+1')]);

        $article = new Article;
        $result = $article->getArticle($article_id);
        if(!isset($result) && empty($result)) {
            abort(404);
        }
        
        $videoList = Youtube::listChannelVideos('UCXWoMTRWJTIZwUblljo5aDQ', 1, 'date');
        $youtube_latest_video_id = $videoList[0]->id->videoId;

        $data = [
            'article' => $result,
            'youtube_video_id' => $youtube_latest_video_id,
            'current_nav_tab' => 'news',
        ];
        return view('user/article', $data);
    }
}
