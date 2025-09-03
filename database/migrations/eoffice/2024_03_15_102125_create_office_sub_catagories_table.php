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
        Schema::create('office_sub_catagories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('main_catagory_id');
            $table->smallInteger('status');
            $table->smallInteger('is_delete')->default(0);
            $table->foreign('created_by')->references('id')->on('office_users');
            $table->foreign('main_catagory_id')->references('id')->on('office_main_catagories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_sub_catagories');
    }
};
