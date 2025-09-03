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
        Schema::table('cr_assignment_answer', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable()->after('assignment_id');
            $table->string('result')->nullable()->after('assignment_answer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cr_assignment_answer', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('result');
        });
    }
};
