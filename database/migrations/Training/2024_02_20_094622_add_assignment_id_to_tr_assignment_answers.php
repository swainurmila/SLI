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
        Schema::table('tr_assignment_answers', function (Blueprint $table) {
            $table->integer('assignment_id')->nullable()->after('training_details_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_assignment_answers', function (Blueprint $table) {
            $table->dropColumn('assignment_id');
        });
    }
};
