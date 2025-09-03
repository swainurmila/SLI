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
        Schema::create('office_recyclebins', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('file_id')->nullable();
            $table->string('deleted_form')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_recyclebins');
    }
};
