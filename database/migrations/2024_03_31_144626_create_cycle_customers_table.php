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
        Schema::create('cycle_customers', function (Blueprint $table) {
            $table->id();
            $table->string('Cycle_Id');
            $table->unsignedBigInteger('Customer_Id');
            $table->timestamps();

            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
            $table->foreign('Customer_Id')->references('Customer_Id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycle_customers');
    }
};
