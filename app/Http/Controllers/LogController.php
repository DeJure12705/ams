<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\StudentAttendance;
use App\Models\Fine;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LogController extends Controller
{
    public function viewLogs()
    {
        $logs = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
            ->join('events', 'events.id', '=', 'student_attendances.event_id')
            ->get();
            
        // Get fines with related student and event data
        $fines = Fine::with(['student', 'event'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pages.logs', compact('logs', 'fines'));
    }

    public function generatePDF()
    {
        $logs = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
            ->join('events', 'events.id', '=', 'student_attendances.event_id')
            ->get();

        $pdf = PDF::loadView('reports.attendance', compact('logs'));
        return $pdf->download('attendance_report.pdf');
    }
}
