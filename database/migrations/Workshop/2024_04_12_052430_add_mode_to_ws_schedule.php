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
        Schema::table('ws_schedule', function (Blueprint $table) {
            $table->enum('workshop_mode', ['online', 'offline'])->nullable()->after('workshop_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ws_schedule', function (Blueprint $table) {
            $table->dropColumn('workshop_mode');
        });
    }
};
