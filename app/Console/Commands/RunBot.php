<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use React;
use Slack;
use App\Tweet; 
class RunBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:run_bot';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the bot';
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
        $loop = React\EventLoop\Factory::create();
        $client = new Slack\RealTimeClient($loop);
        $client->setToken(config('services.slack.client_token'));
        // C0308F8TS
        $client->on('message', function ($data) use ($client) {
            echo "Someone typed a message: ".$data['text']."\n";
            // echo $data;
            echo 'Replying...';
            $tweet = Tweet::inRandomOrder()->get()->first();
            $tweet = json_decode($tweet->tweet)->text;
            echo $tweet;

            $client->getChannelById(config('services.slack.client_channel_id'))->then(function (\Slack\Channel $channel) use ($client, $tweet) {
                $message = $client->getMessageBuilder()
                    ->setText($tweet)
                    ->setChannel($channel)
                    ->create();
                $client->postMessage($message);
            });
            echo 'Replied!';
            
            // $client->disconnect();
        });
        $client->connect()->then(function () {
            echo "Connected!\n";
            $client->getChannelById(config('services.slack.client_channel_id'))->then(function (\Slack\Channel $channel) use ($client) {
                $client->send($tweet, $channel);
            });
        });
        $loop->run();
    }

};


