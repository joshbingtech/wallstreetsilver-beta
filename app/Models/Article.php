<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'user_id',
        'views',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->withTrashed();
    }

    public function commentsAndReplies()
    {
        return $this->hasMany(Comment::class)->withTrashed();
    }

    public function countAllArticles()
    {
        return $this->count();
    }

    public function countArticlesOfCurrentMonth()
    {
        return $this->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
    }

    public function getArticle($article_id)
    {
        return $this->find($article_id);
    }

    public function getFeaturedArticles()
    {
        return $this->orderBy('views', 'desc')->limit(5)->get();
    }

    public function getArticlesForCarousel()
    {
        return $this->orderBy('views', 'desc')->limit(3)->get();
    }

    public function getArticles()
    {
        return $this->orderBy('created_at', 'desc')->paginate(5);
    }
}
