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
        Schema::table('tr_training_orders', function (Blueprint $table) {
            $table->enum('training_duration_type',['Day','Week','Month'])->nullable()->after('language_id');
            $table->integer('training_duration')->nullable()->after('training_duration_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_training_orders', function (Blueprint $table) {
            $table->dropColumn('training_duration_type');
            $table->dropColumn('training_duration');
        });
    }
};
