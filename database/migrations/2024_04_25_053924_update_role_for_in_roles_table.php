<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            DB::statement("ALTER TABLE roles MODIFY COLUMN role_for ENUM('1', '2', '3', '4','5','6') DEFAULT NULL AFTER `name`");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            DB::statement("ALTER TABLE roles MODIFY COLUMN role_for ENUM('1', '2', '3','4','5') DEFAULT NULL AFTER `name`");
        });
    }
};
