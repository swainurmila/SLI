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
        Schema::table('tr_training', function (Blueprint $table) {
            $table->date('enroll_start_date')->nullable()->after('language_id');
            $table->date('enroll_end_date')->nullable()->after('enroll_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_training', function (Blueprint $table) {
            $table->dropColumn('enroll_start_date');
            $table->dropColumn('enroll_end_date');

        });
    }
};
