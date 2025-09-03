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
        Schema::create('workshop', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->enum('workshop_type', ['Boiler Management', 'Stress Management', 'Organizational Behaviour'])->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->enum('workshop_mode', ['online', 'offline'])->nullable();
            $table->float('price')->nullable();
            $table->string('location')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshop');
    }
};
