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
        Schema::create('tr_transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('training_id')->nullable();
            $table->String('user_id')->nullable();
            $table->float('amount')->nullable();
            $table->String('currency_type')->nullable();
            $table->String('txn_id')->nullable();
            $table->String('txn_ref_no')->nullable();
            $table->date('txn_dt')->nullable();
            $table->String('bank_ref_no')->nullable(); 
            $table->String('bank_id')->nullable();
            $table->String('checksum')->nullable();
            $table->bigInteger('status')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_transaction');
    }
};
