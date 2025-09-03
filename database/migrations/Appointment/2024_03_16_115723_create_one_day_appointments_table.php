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
        Schema::create('one_day_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('visiting_office')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('officer')->nullable();
            $table->string('purpose')->nullable();
            $table->date('visiting_date')->nullable();
            $table->string('identity_type')->nullable();
            $table->string('identity_number')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('one_day_appointments');
    }
};
