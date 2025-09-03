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
        Schema::table('cr_course', function (Blueprint $table) {
            $table->enum('payment_type', ['paid', 'free'])->nullable()->after('student_strength');
            $table->enum('certificate_type', ['with', 'without'])->nullable()->after('payment_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cr_course', function (Blueprint $table) {
            $table->dropColumn('payment_type');
            $table->dropColumn('certificate_type');
        });
    }
};
