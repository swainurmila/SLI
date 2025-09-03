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
        Schema::create('office_mail_masters', function (Blueprint $table) {
            $table->id();
            $table->string('mail_title')->nullable();
            
            $table->text('mail_content')->nullable();
            $table->integer('status')->nullable();
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_mail_masters');
    }
};
