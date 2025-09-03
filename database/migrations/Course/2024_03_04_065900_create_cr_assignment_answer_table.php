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
        Schema::create('cr_assignment_answer', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->integer('syllabus_id')->nullable();
            $table->integer('assignment_id')->nullable();
            $table->string('assignment_answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cr_assignment_answer');
    }
};
