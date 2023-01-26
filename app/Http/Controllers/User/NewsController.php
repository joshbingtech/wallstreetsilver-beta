<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class NewsController extends Controller
{
    public function index() {

    }

    public function displayArticle($article_id) {
        $article = new Article;
        $data = [
            'article' => $article->getArticle($article_id),
            'current_nav_tab' => 'news',
        ];
        return view('user/article', $data);
    }
}
