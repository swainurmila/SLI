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
        Schema::create('tr_meeting_details', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('training_details_id')->nullable();
            $table->string('meeting_id')->nullable();
            $table->string('topic')->nullable();
            $table->string('agenda')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->longText('start_url')->nullable();
            $table->longText('join_url')->nullable();
            $table->string('meeting_password')->nullable();
            $table->string('duration')->nullable();
            $table->enum('host_video',['true','false'])->nullable();
            $table->enum('participant_video',['true','false'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_meeting_details');
    }
};
