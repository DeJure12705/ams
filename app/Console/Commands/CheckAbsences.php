<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Fine;
use App\Models\FineSettings;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Console\Command;

class CheckAbsences extends Command
{
    protected $signature = 'check:absences';
    protected $description = 'Check for student absences and create fines';

    public function handle()
    {
        $settings = FineSettings::firstOrCreate(['id' => 1], [
            'fine_amount' => 25.00
        ]);

        $event = Event::where('date', now()->format('Y-m-d'))->first();
        if (!$event) {
            $this->info('No event today');
            return;
        }

        // Get all students
        $students = Student::all();
        foreach ($students as $student) {
            $attendance = StudentAttendance::where('student_rfid', $student->s_rfid)
                ->where('event_id', $event->id)
                ->first();

            // If no attendance record exists or incomplete attendance
            if (!$attendance || !$attendance->attend_checkIn || !$attendance->attend_checkOut) {
                Fine::create([
                    'student_id' => $student->id,
                    'event_id' => $event->id,
                    'absences' => 1,
                    'fine_amount' => $settings->fine_amount,
                    'total_fines' => $settings->fine_amount,
                    'morning_checkin' => $attendance ? (bool)$attendance->attend_checkIn : false,
                    'morning_checkout' => $attendance ? (bool)$attendance->attend_checkOut : false
                ]);
            }
        }
    }
}
