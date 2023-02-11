<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    use HasFactory;

    protected $table = 'youtube_videos';

    protected $fillable = [
        'youtube_video_id',
    ];
}
