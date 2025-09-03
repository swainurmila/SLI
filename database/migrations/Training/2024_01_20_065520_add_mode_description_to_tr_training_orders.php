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
            $table->longText('description')->nullable();
            $table->enum('training_mode',['online','offline'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_training_orders', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('training_mode');
        });
    }
};
