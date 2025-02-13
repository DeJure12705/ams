<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fine;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class FineController extends Controller
{
    private const FINE_AMOUNT = 25.00;

    public function view(){
        $logs = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
        ->join('events', 'events.id', '=', 'student_attendances.event_id')
        ->get();

    // Get fines with related student and event data
    $fines = Fine::with(['student', 'event'])
        ->orderBy('created_at', 'desc')
        ->get();


    $events = Event::select('*')->orderBy('created_at')->get();
        return view('pages.fines', compact('logs', 'fines', 'events'));
    }

    public function calculateEventFines(Event $event)
    {
        // Get all enrolled students
        $allStudents = Student::where('s_status', 'ENROLLED')->get();

        foreach ($allStudents as $student) {
            // Check if student has attendance record for this event
            $attendance = StudentAttendance::where('event_id', $event->id)
                                         ->where('student_rfid', $student->s_rfid)
                                         ->first();

            // Calculate missed actions and fines
            $missedActions = $this->calculateMissedActions($attendance);
            $missedCount = array_sum(array_map(fn($v) => $v ? 1 : 0, $missedActions));

            if ($missedCount > 0) {
                $totalFines = $missedCount * self::FINE_AMOUNT;

                // Create or update fine record
                Fine::updateOrCreate(
                    [
                        'event_id' => $event->id,
                        'student_rfid' => $student->s_rfid
                    ],
                    [
                        'attendance_id' => $attendance?->id, // Use null-safe operator
                        'fine_amount' => self::FINE_AMOUNT,
                        'morning_checkIn_missed' => $missedActions['morning_checkIn_missed'],
                        'morning_checkOut_missed' => $missedActions['morning_checkOut_missed'],
                        'afternoon_checkIn_missed' => $missedActions['afternoon_checkIn_missed'],
                        'afternoon_checkOut_missed' => $missedActions['afternoon_checkOut_missed'],
                        'total_fines' => $totalFines
                    ]
                );
            }
        }
    }

    private function calculateMissedActions(?StudentAttendance $attendance): array
    {
        if (!$attendance) {
            return [
                'morning_checkIn_missed' => true,
                'morning_checkOut_missed' => true,
                'afternoon_checkIn_missed' => true,
                'afternoon_checkOut_missed' => true
            ];
        }

        return [
            'morning_checkIn_missed' => !$attendance->attend_checkIn,
            'morning_checkOut_missed' => !$attendance->attend_checkOut,
            'afternoon_checkIn_missed' => !$attendance->attend_checkIn,
            'afternoon_checkOut_missed' => !$attendance->attend_checkOut
        ];
    }

    public function viewFines()
    {
        $fines = Fine::with(['student', 'event'])->get();
        return view('pages.fines', compact('fines'));
    }
}
