<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tweet; 
use Abraham\TwitterOAuth\TwitterOAuth;


class TestTweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $connection = new TwitterOAuth(
            config('services.twitter.client_id'), 
            config('services.twitter.client_secret'),
            config('services.twitter.access_token'), 
            config('services.twitter.access_token_secret')
            );
        
        $tweets = collect($connection->get("statuses/user_timeline", [ 'screen_name' =>"realdonaldtrump" ]));

        // print_r($tweets->first());

        $tweets->each(function($data) {

            $exists = Tweet::where('tweet_id', $data->id)->first();

            if (!$exists) {

                $tweet = new Tweet();
                $tweet->tweet_id = $data->id;
                $tweet->tweet = json_encode($data);
                // Wed Jan 18 17:33:25 +0000 2017
                $tweet->created_at = \Carbon\Carbon::createFromFormat('D M d H:i:s O Y', $data->created_at);
                $tweet->save();

            }

        });



        // $tweet = new Tweet; 
        // $tweet->tweet = 'hello';
        // $tweet->save();  
        // $tweet = Tweet::find(16);
        // // $tweet->delete();
        // Tweet::getQuery()->delete();
        



        // $tweets = Tweet::withTrashed()->where('tweet', 'foo')->get();
        // $tweets = Tweet::orderBy('created_at', 'asc')->limit(1)->get();
        // $this->info($tweets->first()->tweet);
     }
}
