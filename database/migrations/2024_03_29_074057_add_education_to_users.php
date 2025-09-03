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
        Schema::table('users', function (Blueprint $table) {
            $table->string('education')->nullable()->after('district_id');
            $table->string('course_name')->nullable()->after('education');
            $table->string('passing_year')->nullable()->after('course_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('education');
            $table->dropColumn('course_name');
            $table->dropColumn('passing_year');
        });
    }
};
