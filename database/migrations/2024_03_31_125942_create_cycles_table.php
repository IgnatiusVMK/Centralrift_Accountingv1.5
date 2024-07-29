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
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->string('Cycle_Id')->unique();
            $table->unsignedInteger('Block_Id');
            $table->string('Crop');
            $table->string('Client_Name');
            $table->string('Cycle_Name');
            $table->date('Cycle_Start');
            $table->date('Cycle_End');
            $table->string('Status')->default('pending');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->unsignedBigInteger('maker_id')->nullable();
            $table->timestamps();

            $table->foreign('checker_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('users');
            $table->foreign('Block_Id')->references('Block_Id')->on('blocks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
