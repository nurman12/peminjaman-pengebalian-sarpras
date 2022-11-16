<?php

namespace App\Console;

use App\Console\Commands\PeminjamanKadaluarsa;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $command = [
        SendRemiderEmails::class,
        PeminjamanKadaluarsa::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // recommend set at 16:00 / tutup jam oprasional
        $schedule->command('peminjaman:expired')
            ->dailyAt('09:41');

        // reminder akan berjalan 2 kali pertama, 
        // ketika besok berakhir dan hari ini berakhir
        $schedule->command('reminder:emails')
            ->dailyAt('19:29');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
