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
        Schema::table('tr_meeting_details', function (Blueprint $table) {
            $table->enum('meeting_for',['training','course'])->nullable()->after('training_details_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_meeting_details', function (Blueprint $table) {
            $table->dropColumn('meeting_for');
        });
    }
};
