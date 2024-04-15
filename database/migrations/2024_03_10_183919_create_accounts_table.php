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
            $table->string('Description');
            $table->integer('Crd_Amnt');
            $table->integer('Dbt_Amt');
            $table->integer('Bal');
            $table->dateTime('Crd_Dbt_Date');
            $table->dateTime('Date_Created');
            $table->timestamps();
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
