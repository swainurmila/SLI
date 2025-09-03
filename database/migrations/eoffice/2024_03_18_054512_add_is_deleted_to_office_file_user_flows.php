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
        Schema::table('office_file_user_flows', function (Blueprint $table) {
            $table->smallInteger('reply_forwards')->default(0)->after('due_date');
            $table->longText('is_deleted')->nullable()->after('reply_forwards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('office_file_user_flows', function (Blueprint $table) {
            $table->dropColumn('reply_forwards');
            $table->dropColumn('is_deleted');
        });
    }
};
