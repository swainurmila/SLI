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
        Schema::create('cr_total_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->nullable();
            $table->enum('question_type', ['1', '2', '3'])->nullable()->comment('1: subjective, 2: long question, 3: short question');
            $table->Integer('no_of_questions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cr_total_questions');
    }
};
