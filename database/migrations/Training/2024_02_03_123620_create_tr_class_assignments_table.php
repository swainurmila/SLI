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
        Schema::create('tr_class_assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id')->nullable();
            $table->integer('training_details_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('question_file')->nullable();
            $table->string('assignment_title')->nullable();
            $table->enum('question_type',['subjective','objective'])->nullable();
            $table->enum('question_level',['easy','medium','hard'])->nullable();
            $table->string('start_date')->nullable();
            $table->string('last_submission_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_class_assignments');
    }
};
