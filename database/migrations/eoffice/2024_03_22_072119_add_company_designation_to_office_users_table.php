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
        Schema::table('office_users', function (Blueprint $table) {
            $table->string('company')->nullable()->after('contact_no');
            $table->string('designation')->nullable()->after('company');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('office_users', function (Blueprint $table) {
            $table->dropColumn('company');
            $table->dropColumn('designation');
        });
    }
};
