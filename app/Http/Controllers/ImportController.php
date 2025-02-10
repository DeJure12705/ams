<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ImportController extends Controller
{
    // Import the Student
    public function import(Request $request)
    {
        try {
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            // Get the uploaded file
            $file = $request->file('file');
            // Process the Excel file
            Excel::import(new StudentImport, $file->store('files'));

            return redirect()->back()->with('success', "Data Imported Successfully");
        } catch (Throwable $error) {
            dd($error);
            if ($error->getCode() == 23000) { //23000 is Integrity Constraint error
                return redirect()->back()->with('error', 'Duplicate Entries not allowed'); //For Duplicate Entries
            }
            return redirect()->back()->with('error', $error->getMessage());
        }
    }
}
