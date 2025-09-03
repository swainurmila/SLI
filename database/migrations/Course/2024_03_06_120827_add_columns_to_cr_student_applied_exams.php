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
        Schema::table('cr_student_applied_exams', function (Blueprint $table) {
            $table->tinyInteger('attendance')->nullable()->after('exam_notification_id');
            $table->string('score')->nullable()->after('attendance');
            $table->string('result')->nullable()->after('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cr_student_applied_exams', function (Blueprint $table) {
            $table->dropColumn('attendance');
            $table->dropColumn('score');
            $table->dropColumn('result');
        });
    }
};
