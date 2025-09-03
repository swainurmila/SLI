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
        Schema::create('cr_course_assignment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('syllabus_id')->nullable();
            $table->string('assignment_title')->nullable();
            $table->enum('question_type',['subjective','objective'])->nullable();
            $table->enum('question_level',['easy','medium','hard'])->nullable();
            $table->date('start_submission_date')->nullable();
            $table->date('end_submission_date')->nullable();
            $table->float('pass_score')->nullable();
            $table->string('question_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cr_course_assignment');
    }
};
