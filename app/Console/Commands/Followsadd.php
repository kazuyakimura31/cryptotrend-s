<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\FollowsController;

class Followsadd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:followsadd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'twitterユーザーを日毎にDB追加、定期バッジ。';

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
        FollowsController::addfollow();
    }
}
