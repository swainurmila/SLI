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
        Schema::create('office_file_user_flows', function (Blueprint $table) {
            $table->id();
            
            $table->integer('file_id')->nullable();
             
            $table->integer('from_user_id')->nullable();
            
            $table->integer('to_user_id')->nullable();
            
            $table->json('cc_user_id')->nullable();
            
            $table->string('subject')->nullable();
            
            $table->string('receipt_no')->nullable();
            
            $table->integer('priority_type')->nullable();
            
            $table->string('remarks')->nullable();
            
            $table->date('due_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_file_user_flows');
    }
};
