<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = new User;
        $article = new Article;
        $comment = new Comment;
        
        $data = [
            'current_nav_tab' => 'dashboard',
            'total_user_records' => $user->countAllRecords(),
            'total_admins' => $user->countAllAdmins(),
            'total_journalists' => $user->countAllJournalists(),
            'total_users' => $user->countAllUsers(),
            'total_articles' => $article->countAllArticles(),
            'total_articles_current_month' => $article->countArticlesOfCurrentMonth(),
            'total_comments' => $comment->countAllComments(),
            'total_comments_current_month' => $comment->countCommentsOfCurrentMonth(),
            'featured_articles' => $article->getFeaturedArticles(),
        ];
        return view('admin/dashboard', $data);
    }
}
