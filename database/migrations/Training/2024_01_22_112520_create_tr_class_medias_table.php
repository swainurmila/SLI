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
        Schema::create('tr_class_medias', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->enum('media_type',['audio','video'])->nullable();
            $table->string('media_file')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_class_medias');
    }
};
