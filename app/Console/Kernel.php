<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Check for absences every day after event end time
        $schedule->command('check:absences')->dailyAt('20:00');

        // Calculate fines after check-out period ends
        $schedule->command('fines:calculate')
            ->dailyAt('17:00')  // Adjust this time to after your last check-out period
            ->appendOutputTo(storage_path('logs/fines.log'));
    }

    // ...existing code...
}
