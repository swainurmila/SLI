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
        Schema::create('tr_meeting_oauth_details', function (Blueprint $table) {
            $table->id();
            $table->longText('access_token')->nullable();
            $table->longText('refresh_token')->nullable();
            $table->string('scope')->nullable();
            $table->enum('meeting_for',['zoom','google-meet'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_meeting_oauth_details');
    }
};
