<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\CoinsController;

class Coinshour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:coinshour';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Coinsの1時間のツイート数を定期バッジ';

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
        CoinsController::hour();
    }
}
