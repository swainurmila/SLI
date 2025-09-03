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
        Schema::table('cr_examination', function (Blueprint $table) {
            $table->enum('exam_mode',['online','offline'])->nullable()->after('exam_title');
            $table->integer('exam_mark')->nullable()->after('exam_mode');
            $table->integer('passing_mark')->nullable()->after('exam_mark');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cr_examination', function (Blueprint $table) {
            $table->dropColumn('exam_mode');
            $table->dropColumn('exam_mark');
            $table->dropColumn('passing_mark');
        });
    }
};
