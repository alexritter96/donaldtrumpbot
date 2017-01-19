<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tweet; 
use Abraham\TwitterOAuth\TwitterOAuth;


class TestRandomTweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:random_tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returna a random tweet';

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
        $tweet = Tweet::inRandomOrder()->get()->first();
        echo var_export(json_decode($tweet->tweet)->text);
        // $tweets = Tweet::orderBy('created_at', 'asc')->limit(1)->get();
        // $this->info($tweets->first()->tweet);
    

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
};