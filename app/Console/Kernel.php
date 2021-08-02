<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\CoinsController;
use App\Http\Controllers\FollowsController;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Coinshour::class,
        \App\Console\Commands\Coinsday::class,
        \App\Console\Commands\Coinsweek::class,
        \App\Console\Commands\Coinshighlow::class,
        \App\Console\Commands\Followsadd::class,
        \App\Console\Commands\Followsauto::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('batch:coinshour')->hourly();//毎時、１時間のツイート数を更新
        $schedule->command('batch:coinsday')->daily();//毎日、１日のツイート数を更新
        $schedule->command('batch:coinsweek')->daily();//毎日、１週間のツイート数を更新
        $schedule->command('batch:coinshighlow')->daily();//毎日、Coinの最高取引価格、最安取引価格を更新
        $schedule->command('batch:followsadd')->daily();//毎日、twitterユーザーのDB追加を更新
        $schedule->command('batch:followsauto')->everyFifteenMinutes();//15分毎、twitterユーザーの自動フォローを更新
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
