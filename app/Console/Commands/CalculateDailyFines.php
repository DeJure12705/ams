<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Fine;
use App\Models\FineSettings;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateDailyFines extends Command
{
    protected $signature = 'fines:calculate';
    protected $description = 'Calculate fines for students who missed attendance';

    public function handle()
    {
        $event = Event::where('date', Carbon::today()->format('Y-m-d'))->first();
        
        if (!$event) {
            $this->info('No event today');
            return;
        }

        $currentTime = Carbon::now();
        $checkInEnd = Carbon::parse($event->date . ' ' . $event->checkIn_end);
        $checkOutEnd = Carbon::parse($event->date . ' ' . $event->checkOut_end);

        // Only calculate if at least one period has ended
        if ($currentTime->lt($checkInEnd) && $currentTime->lt($checkOutEnd)) {
            $this->info('Attendance periods have not ended yet');
            return;
        }

        // Calculate fines logic here
        // ...existing fine calculation logic...
    }
}
