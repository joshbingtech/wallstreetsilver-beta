<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
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
        return $this->hasMany(Reaction::class)->where('action', 1)->where('user_id', Auth::user()->id);
    }

    public function user_disliked()
    {
        return $this->hasMany(Reaction::class)->where('action', 0)->where('user_id', Auth::user()->id);
    }
}
