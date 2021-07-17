<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\CoinsController;

class Coinshighlow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:coinshighlow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Coinsの最高取引価格、最安取引価格を定期バッジ';

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
        CoinsController::highlow();
    }
}
