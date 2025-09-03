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
        Schema::table('office_file_user_flow_drafts', function (Blueprint $table) {
            $table->longText('forward_message')->nullable()->after('reply_forwards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('office_file_user_flow_drafts', function (Blueprint $table) {
            $table->dropColumn('forward_message');
        });
    }
};
