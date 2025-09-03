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
        Schema::table('cr_notification', function (Blueprint $table) {
            $table->string('exam_start_time')->nullable();
            $table->string('hours_needed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cr_notification', function (Blueprint $table) {
            $table->dropColumn('exam_start_time');
            $table->dropColumn('hours_needed');
        });
    }
};
