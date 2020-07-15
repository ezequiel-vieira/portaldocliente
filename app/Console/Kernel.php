<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\GetNews::class,
        Commands\GetCatalogo::class,
        Commands\getAllUsers::class,
        Commands\GetUserRefundDocs::class,
        Commands\GetDailyNews::class,
        Commands\GetNewsletter::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        //---------DAILY CRON JOBS----------//
        //CATALOGO
        /*$schedule->command('catalogo:list')
                ->dailyAt('00:00')
                ->withoutOverlapping();*/
        //NOVIDADES
        $schedule->command('news:list')
                ->dailyAt('02:00')
                ->withoutOverlapping();
        //USERS;USER_ACCOUNT;USER_CURRENT_ACCOUNT
        /*$schedule->command('users:list')
                ->dailyAt('03:00')
                ->emailOutputTo('ezequiel.vieira@gruponobrega.pt')
                ->withoutOverlapping();*/
        //DEVOLUCAO
        /*$schedule->command('users:refund_docs')
                ->dailyAt('03:30')
                ->emailOutputTo('ezequiel.vieira@gruponobrega.pt')
                ->withoutOverlapping();*/
        //DAILY NEWS
        $schedule->command('dailynews:list')
                ->dailyAt('04:00')
                ->withoutOverlapping();
        //NEWSLETTER
        $schedule->command('newsletter:list')
                ->weeklyOn(1, '04:30')
                ->withoutOverlapping();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
