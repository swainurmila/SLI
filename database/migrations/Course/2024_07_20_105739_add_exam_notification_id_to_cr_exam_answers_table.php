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
        Schema::table('cr_exam_answers', function (Blueprint $table) {
            $table->integer('exam_notification_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cr_exam_answers', function (Blueprint $table) {
            $table->dropColumn('exam_notification_id');
        });
    }
};
