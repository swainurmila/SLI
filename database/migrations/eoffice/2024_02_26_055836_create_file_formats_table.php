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
        Schema::create('file_formats', function (Blueprint $table) {
            $table->id();
            $table->string('file_type');
            $table->unsignedBigInteger('created_by');
            $table->smallInteger('status');
            $table->double('max_limit')->nullable();
            $table->smallInteger('is_delete')->default(0);
            $table->foreign('created_by')->references('id')->on('office_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_formats');
    }
};
