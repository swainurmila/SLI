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
        Schema::create('tr_training_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('training_id')->nullable();
            $table->integer('batch_id')->nullable();
            $table->string('class_name')->nullable();
            $table->enum('class_mode',['online','offline'])->nullable();
            $table->date('class_date')->nullable();
            $table->string('class_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_training_classes');
    }
};
