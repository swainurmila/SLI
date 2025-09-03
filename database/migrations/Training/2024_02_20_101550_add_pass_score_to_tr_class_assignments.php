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
        Schema::table('tr_class_assignments', function (Blueprint $table) {
            $table->string('pass_score')->nullable()->after('last_submission_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_class_assignments', function (Blueprint $table) {
            $table->dropColumn('pass_score');
        });
    }
};
