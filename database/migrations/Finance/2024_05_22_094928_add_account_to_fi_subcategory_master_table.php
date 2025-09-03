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
        Schema::table('fi_subcategory_master', function (Blueprint $table) {
            $table->string("account_number")->nullable()->after('sub_category_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fi_subcategory_master', function (Blueprint $table) {
            $table->dropColumn('account_number');
        });
    }
};
