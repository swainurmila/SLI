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
        Schema::table('rp_submitted_papers', function (Blueprint $table) {
            $table->date('publish_date')->nullable()->after('is_publish');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rp_submitted_papers', function (Blueprint $table) {
            $table->dropColumn('publish_date');
        });
    }
};
