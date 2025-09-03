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
            $table->date('exam_date')->nullable()->after('notification_title');
            $table->text('exam_location')->nullable()->after('exam_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cr_notification', function (Blueprint $table) {
            $table->dropColumn('exam_date');
            $table->dropColumn('exam_location');
        });
    }
};
