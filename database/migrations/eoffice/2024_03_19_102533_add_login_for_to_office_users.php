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
            $table->enum('login_for',['office','appointment'])->default('appointment')->after('is_delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('office_users', function (Blueprint $table) {
            $table->dropColumn('login_for');
        });
    }
};
