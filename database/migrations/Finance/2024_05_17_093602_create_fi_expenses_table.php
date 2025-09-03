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
        Schema::create('fi_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('budget_type')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('pay_form')->nullable();
            $table->string('amount')->nullable();
            $table->string('pay_to')->nullable();
            $table->string("bank_name")->nullable();
            $table->string("account_number")->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('document')->nullable();
            $table->string('purpose')->nullable();
            $table->string('previous_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fi_expenses');
    }
};
