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
        Schema::create('cr_attendance', function (Blueprint $table) {
            $table->id();
            $table->enum('attendance_type',['0','1'])->nullable();
            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('syllabus_id')->nullable();
            $table->bigInteger('class_id')->nullable();
            $table->bigInteger('student_id')->nullable();
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->string('regularization_remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cr_attendance');
    }
};
