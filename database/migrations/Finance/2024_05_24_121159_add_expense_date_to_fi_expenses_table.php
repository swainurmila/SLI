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
        Schema::table('fi_expenses', function (Blueprint $table) {
            $table->date("expense_date")->nullable()->after('previous_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fi_expenses', function (Blueprint $table) {
            $table->dropColumn('expense_date');
        });
    }
};
