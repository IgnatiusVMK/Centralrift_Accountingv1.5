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
        Schema::create('financials', function (Blueprint $table) {
            $table->id('Financial_Id');
            $table->string('Fin_Id_Id');
            $table->string('type');
            $table->string('Reason');
            $table->string('Description');
            $table->integer('Amount');
            $table->string('Cycle_Id');
            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financials');
    }
};
