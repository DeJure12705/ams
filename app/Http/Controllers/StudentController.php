<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function create(Request $request)
    {
        $fields = $request->validate([
            "s_rfid" => ["required", "unique:students,s_rfid"],
            "s_studentID" => ["required", "unique:students,s_studentID"],
            "s_fname" => ["required"],
            "s_lname" => ["required"],
            "s_program" => ["required"],
            "s_lvl" => ["required"],
            "s_set" => ["required"],
        ]);
        $path = null;
        if ($request->hasFile('s_image')) {
            $request->file('s_image')->store('profile_pictures');
            $path = $request->file('s_image')->getClientOriginalName();
        }
        $fields["s_suffix"] = $request->s_suffix;
        $fields['s_mname'] = $request->s_mname;
        $fields['s_image'] = $path;
        $fields['s_status'] = "ENROLLED";
        Student::create($fields);
        return back()->with("success", "Student Added Successfully");
    }

    public function view()
    {
        $students = Student::all();
        return view('pages.students', compact('students'));
    }
    public function update(Request $request)
    {

        $fields = $request->validate([
            "id" => ['required'],
            "s_rfid" => ["required"],
            "s_studentID" => ["required"],
            "s_fname" => ["required"],
            "s_lname" => ["required"],
            "s_program" => ["required"],
            "s_lvl" => ["required"],
            "s_set" => ["required"],
        ]);
        $path = null;
        if ($request->hasFile('s_image')) {
            $request->file('s_image')->store('profile_pictures');
            $path = $request->file('s_image')->getClientOriginalName();
        }

        $fields["s_suffix"] = $request->s_suffix;
        $fields['s_mname'] = $request->s_mname;
        $fields['s_image'] = $path;
        $fields['s_status'] = "ENROLLED";

        $student = Student::where('id', $request->id)->update($fields);
        return back()->with(['successful' => "Student updated successfully"]);
    }
    public function delete(Request $request)
    {
        $request->validate([
            "id" => ['required']
        ]);

        Student::find($request->id)->delete();
        return back()->with(['successful' => "Student deleted successfully"]);
    }
}
