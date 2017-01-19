<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tweet; 


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
     }
};