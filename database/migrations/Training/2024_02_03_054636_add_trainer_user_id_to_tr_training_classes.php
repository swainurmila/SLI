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
        Schema::table('tr_training_classes', function (Blueprint $table) {
            $table->integer('trainer_user_id')->nullable()->after('training_details_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_training_classes', function (Blueprint $table) {
            $table->dropColumn('trainer_user_id');
        });
    }
};
