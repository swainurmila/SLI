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
        Schema::table('book_requests', function (Blueprint $table) {
            $table->smallInteger('issue_status')->nullable()->after('return_date');
            $table->smallInteger('return_status')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->double('penalty')->nullable();
            $table->bigInteger('issue_approve_id')->nullable();
            $table->bigInteger('return_approve_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_requests', function (Blueprint $table) {
            //
        });
    }
};
