<?php

namespace App\Console;

use App\Models\Payment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('repair:payment:status')->hourly();

        //Geciken ödemelerin bildirimleri
        $schedule->command('ownerclick:notify:payment-delay 3')->hourly();
        $schedule->command('ownerclick:notify:payment-delay 15')->hourly();
        $schedule->command('ownerclick:notify:payment-delay 30')->hourly();
        $schedule->command('ownerclick:notify:payment-delay 60')->hourly();
        $schedule->command('ownerclick:notify:payment-delay 90')->hourly();
        $schedule->command('ownerclick:notify:payment-delay 120')->hourly();
        $schedule->command('ownerclick:notify:payment-delay 180')->hourly();
        $schedule->command('ownerclick:notify:payment-delay 270')->hourly();
        $schedule->command('ownerclick:notify:payment-delay 360')->hourly();

        //Bitimi yaklaşan sözleşmelerin bildirimleri
        $schedule->command('ownerclick:notify:near-contract-expires 1')->hourly();
        $schedule->command('ownerclick:notify:near-contract-expires 3')->hourly();
        $schedule->command('ownerclick:notify:near-contract-expires 7')->hourly();
        $schedule->command('ownerclick:notify:near-contract-expires 30')->hourly();



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
