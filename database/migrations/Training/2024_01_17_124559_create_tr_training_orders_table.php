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
        Schema::create('tr_training_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('training_id')->nullable();
            $table->integer('training_course_id')->nullable();
            $table->integer('training_place_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('training_category_id')->nullable();
            $table->string('training_start_date')->nullable();
            $table->string('training_end_date')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('original_price')->nullable();
            $table->integer('module_details_id')->nullable();
            $table->integer('payment_type')->nullable();
            $table->integer('training_type')->nullable();
            $table->integer('batch_id')->nullable();
            $table->string('training_name')->nullable();
            $table->integer('language_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_training_orders');
    }
};
