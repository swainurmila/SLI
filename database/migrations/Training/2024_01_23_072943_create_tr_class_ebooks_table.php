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
        Schema::create('tr_class_ebooks', function (Blueprint $table) {
            $table->id();
            $table->integer('training_id')->nullable();
            $table->integer('batch_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('ebook_name')->nullable();
            $table->string('ebook_material')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_class_ebooks');
    }
};
