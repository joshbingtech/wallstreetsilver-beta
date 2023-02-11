<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Tweet;
use App\Models\YoutubeVideo;

use Twitter;
use Alaouy\Youtube\Facades\Youtube;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            //get the latest youtube video ID and store it
            $videoList = Youtube::listChannelVideos('UCXWoMTRWJTIZwUblljo5aDQ', 1, 'date');
            $youtube_video_id = YoutubeVideo::updateOrCreate(
                ['id' => 1],
                ['youtube_video_id' => $videoList[0]->id->videoId]
            );

            //get the latest 5 tweets and store it
            $params = [
                'tweet.fields' => 'text,created_at,id,attachments',
                'expansions' => 'author_id,attachments.media_keys',
                'media.fields' => 'alt_text,url,preview_image_url,variants',
                'user.fields' => 'username',
                'exclude' => 'retweets,replies',
                'max_results' => 5,
            ];
            $json = Twitter::userTweets('1366565625401909249', $params);
            $tweets = Tweet::updateOrCreate(
                ['id' => 1],
                ['tweets' => $json]
            );
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
