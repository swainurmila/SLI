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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('user_name')->nullable()->after('last_name');
            $table->string('contact_no')->nullable()->after('email_verified_at');
            $table->string('registration_no')->nullable()->after('contact_no');
            $table->integer('state_id')->nullable()->after('registration_no');
            $table->integer('district_id')->nullable()->after('state_id');
            $table->text('present_address')->nullable()->after('district_id');
            $table->text('permanent_address')->nullable()->after('present_address');
            $table->string('role')->nullable()->after('role_id');
            $table->smallInteger('status')->default(0)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('user_name');
            $table->dropColumn('contact_no');
            $table->dropColumn('registration_id');
            $table->dropColumn('state_id');
            $table->dropColumn('district_id');
            $table->dropColumn('present_address');
            $table->dropColumn('permanent_address');
            $table->dropColumn('role');
            $table->dropColumn('status');
        });
    }
};
