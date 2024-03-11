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
            $table->foreignId('Supplier_Id')->constrained('suppliers', 'Supplier_Id');
            $table->dateTime('Created_Date');
            $table->string('Quantity');
            $table->integer('Total_Price');
            $table->boolean('Payment_Status');
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
