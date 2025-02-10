<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->nullable()->constrained('student_attendances');
            $table->foreignId('event_id')->constrained('events');
            $table->string('student_rfid');
            $table->decimal('fine_amount', 8, 2);
            $table->boolean('morning_checkIn_missed')->default(false);
            $table->boolean('morning_checkOut_missed')->default(false);
            $table->boolean('afternoon_checkIn_missed')->default(false);
            $table->boolean('afternoon_checkOut_missed')->default(false);
            $table->decimal('total_fines', 8, 2);
            $table->timestamps();

            $table->foreign('student_rfid')->references('s_rfid')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
