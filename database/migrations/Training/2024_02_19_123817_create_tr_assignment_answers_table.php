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
        Schema::create('tr_assignment_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id')->nullable();
            $table->integer('training_details_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('assignment_answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_assignment_answers');
    }
};
