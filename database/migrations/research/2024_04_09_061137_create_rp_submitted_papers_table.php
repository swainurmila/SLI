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
        Schema::create('rp_submitted_papers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('notification_id')->nullable();
            $table->string('paper_title')->nullable();
            $table->string('subject_category')->nullable();
            $table->string('papers')->nullable();
            $table->enum('are_you_a',['Student','Guide'])->nullable();
            $table->longText('description')->nullable();
            $table->enum('is_publish',['0','1'])->default('0');
            $table->enum('issue_certificate',['0','1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rp_submitted_papers');
    }
};
