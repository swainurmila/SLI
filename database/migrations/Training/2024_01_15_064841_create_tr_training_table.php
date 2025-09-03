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
        Schema::create('tr_training', function (Blueprint $table) {
            $table->id();
            
            $table->integer('training_course_id')->nullable();
            $table->integer('training_place_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('training_category_id')->nullable();
            $table->date('training_start_date')->nullable();
            $table->date('training_end_date')->nullable();
            $table->integer('price')->nullable();
            $table->integer('module_details_id')->nullable();
            $table->integer('payment_type')->nullable();
            $table->integer('training_type')->nullable();
            $table->string('name')->nullable();
            $table->integer('language_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_training');
    }
};
