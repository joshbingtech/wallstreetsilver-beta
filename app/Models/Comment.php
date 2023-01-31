<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'article_id',
        'parent_id',
        'comment',
        'depth',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->withTrashed();
    }

    public function likes()
    {
        return $this->hasMany(Reaction::class)->where('action', 1);
    }

    public function dislikes()
    {
        return $this->hasMany(Reaction::class)->where('action', 0);
    }

    public function user_liked()
    {
        $user_id = 0;
        if(Auth::check()) {
            $user_id =  Auth::user()->id;
        }
        return $this->hasMany(Reaction::class)->where('action', 1)->where('user_id', $user_id);
    }

    public function user_disliked()
    {
        $user_id = 0;
        if(Auth::check()) {
            $user_id =  Auth::user()->id;
        }
        return $this->hasMany(Reaction::class)->where('action', 0)->where('user_id', $user_id);
    }

    public function countAllComments()
    {
        return $this->withTrashed()->count();
    }

    public function countCommentsOfCurrentMonth()
    {
        return $this->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->withTrashed()
            ->count();
    }
}
