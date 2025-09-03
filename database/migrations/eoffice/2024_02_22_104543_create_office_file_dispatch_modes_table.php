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
        Schema::create('office_file_dispatch_modes', function (Blueprint $table) {
            $table->id();
            
            $table->integer('file_id')->nullable();
            
            $table->integer('dispatch_mode_id')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_file_dispatch_modes');
    }
};
