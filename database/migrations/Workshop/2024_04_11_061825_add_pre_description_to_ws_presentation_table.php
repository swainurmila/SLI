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
        Schema::table('ws_presentation', function (Blueprint $table) {
            $table->text('pre_description')->nullable()->after('document');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ws_presentation', function (Blueprint $table) {
            $table->dropColumn('pre_description');
        });
    }
};
