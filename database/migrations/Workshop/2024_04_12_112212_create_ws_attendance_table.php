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
        Schema::create('ws_attendance', function (Blueprint $table) {
            $table->id();
            $table->enum('attendance_type',['0','1'])->nullable();
            $table->bigInteger('workshop_id')->nullable();
            $table->bigInteger('schedule_id')->nullable();
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
        Schema::dropIfExists('ws_attendance');
    }
};
