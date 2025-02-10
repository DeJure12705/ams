<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboard()
    {

        $studentCount = Student::all()->count();
        $graduateCount = Student::where('s_status', 'GRADUATED')->get()->count(); //Fetch all graduate counts
        $attendances = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
            ->join('events', 'events.id', '=', 'student_attendances.event_id')
            ->get();
        return view('dashboard', compact('studentCount', 'attendances', 'graduateCount'));
    }

    public function test(Request $request) {}
}
