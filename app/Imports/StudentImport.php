<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Ensure the program is either BSIS or BSIT
        // $validPrograms = ['BSIS', 'BSIT'];
        // $program = strtoupper(trim($row[6])); // Convert to uppercase and trim spaces

        // Default to 'BSIT' if invalid value is found (or handle it differently)
        // if (!in_array($program, $validPrograms)) {
        //     $program = 'BSIT'; // Change this behavior if needed
        // }
        return new Student([
            "s_rfid" => $row[0],
            "s_studentID" => $row[1],
            "s_fname" => $row[2],
            "s_lname" => $row[3],
            "s_mname" => $row[4],
            "s_suffix" => $row[5],
            "s_program" => $row[6],
            "s_lvl" => $row[7],
            "s_set" => $row[8],
            "s_image" => $row[9],
            "s_status" => "TO BE UPDATED",
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
