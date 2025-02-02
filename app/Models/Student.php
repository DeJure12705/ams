<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        "s_rfid",
        "s_studentID",
        "s_fname",
        "s_lname",
        "s_mname",
        "s_suffix",
        "s_program",
        "s_lvl",
        "s_set",
        "s_image",
        "s_status",
    ];
}
