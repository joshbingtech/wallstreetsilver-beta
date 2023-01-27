<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class NewsController extends Controller
{
    public function index() {
        $article = new Article;
        $data = [
            'articles' => $article->getArticles(),
            'current_nav_tab' => 'news',
        ];
        return view('user/news', $data);
    }

    public function displayArticle($article_id) {
        $article_id = base64_decode($article_id);
        $article = new Article;
        $result = $article->getArticle($article_id);
        if(!isset($result) && empty($result)) {
            abort(404);
        }
        $data = [
            'article' => $result,
            'current_nav_tab' => 'news',
        ];
        return view('user/article', $data);
    }
}
