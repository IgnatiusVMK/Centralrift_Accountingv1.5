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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id('Purchase_Id');
            $table->unsignedBigInteger('Supplier_Id');
            $table->string('Cycle_Id');
            $table->string('Quantity');
            $table->integer('Total_Price');
            $table->boolean('Payment_Status');
            $table->foreign('Supplier_Id')->references('Supplier_Id')->on('suppliers');
            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
