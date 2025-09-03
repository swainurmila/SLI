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
        Schema::create('tr_public_medias', function (Blueprint $table) {
            $table->id();
            $table->string('media_title')->nullable();
            $table->enum('media_type',['ebook','audio','video'])->nullable();
            $table->string('media_file')->nullable();
            $table->longText('description')->nullable();
            $table->enum('payment_mode',['free','paid'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_public_medias');
    }
};
