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
        Schema::table('tr_meeting_oauth_details', function (Blueprint $table) {
            $table->enum('module_for',['training','course'])->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_meeting_oauth_details', function (Blueprint $table) {
            $table->dropColumn('module_for');
        });
    }
};
