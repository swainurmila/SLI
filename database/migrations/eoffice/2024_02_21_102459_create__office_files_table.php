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
        Schema::create('office_files', function (Blueprint $table) {

            $table->id();
            $table->integer('delivery_mode_id')->nullable();
            
            $table->date('file_date')->nullable();
            $table->integer('letter_type')->nullable();
            $table->string('file_no')->nullable();
            $table->string('ip_id')->nullable();
            $table->string('mac_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('memo_no')->nullable();
            $table->integer('enclouser_type')->nullable();
            $table->integer('priority_type')->nullable();
            $table->integer('public_type')->nullable();
            $table->string('upload_file')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('to_user_id')->nullable();
            $table->integer('main_category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->string('letter_subject')->nullable();
            $table->integer('created_user_id')->nullable(); 
             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_files');
    }
};
