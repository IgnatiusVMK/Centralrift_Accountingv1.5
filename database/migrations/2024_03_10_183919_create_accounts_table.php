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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('Transaction_Id');
            $table->string('Cycle_Id')->nullable();
            $table->string('Financial_Id')->nullable();
            $table->string('Description');
            $table->integer('Crd_Amnt');
            $table->integer('Dbt_Amt');
            $table->integer('Bal');
            $table->dateTime('Crd_Dbt_Date');
            $table->dateTime('Date_Created');
            $table->string('Status')->default('pending');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->unsignedBigInteger('maker_id')->nullable();
            $table->timestamps();

            $table->foreign('checker_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
