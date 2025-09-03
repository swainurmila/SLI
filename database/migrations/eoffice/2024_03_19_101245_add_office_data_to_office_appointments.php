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
        Schema::table('office_appointments', function (Blueprint $table) {
            $table->string('visiting_office')->nullable();
            $table->string('department')->nullable();
            $table->string('officer')->nullable();
            $table->string('purpose')->nullable();
            $table->date('visiting_date')->nullable();
            $table->string('identity_type')->nullable();
            $table->string('identity_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('office_appointments', function (Blueprint $table) {
            $table->dropColumn('visiting_office');
            $table->dropColumn('department');
            $table->dropColumn('officer');
            $table->dropColumn('purpose');
            $table->dropColumn('visiting_date');
            $table->dropColumn('identity_type');
            $table->dropColumn('identity_number');
        });
    }
};
