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
        Schema::table('ws_workshop_ratings', function (Blueprint $table) {
            $table->tinyinteger('is_delete')->default(1)->after('feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ws_workshop_ratings', function (Blueprint $table) {
            $table->dropColumn('is_delete');
        });
    }
};
