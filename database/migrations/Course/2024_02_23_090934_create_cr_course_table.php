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
        Schema::create('cr_course', function (Blueprint $table) {
            $table->id();
            $table->string('course_name')->nullable();
            $table->bigInteger('course_category_id')->nullable();
            $table->enum('course_mode', ['online', 'offline'])->nullable();
            $table->Integer('student_strength')->nullable();
            $table->date('course_start_date')->nullable();
            $table->date('course_end_date')->nullable();
            $table->float('course_price')->nullable();
            $table->string('course_image')->nullable();
            $table->longText('course_description')->nullable();
            $table->bigInteger('language_id')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cr_course');
    }
};
