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
        Schema::create('book_locations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_id')->nullable();
            $table->string('rack_no')->nullable();
            $table->string('column_no')->nullable();
            $table->string('row_no')->nullable();
            $table->string('unique_req_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_locations');
    }
};
