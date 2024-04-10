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
        if (!Schema::hasTable('sales')) {
            Schema::create('sales', function (Blueprint $table) {
                $table->id('Sales_Id');
                $table->unsignedBigInteger('Customer_Id');
                $table->string('Cycle_Id');
                $table->dateTime('Sale_Date');
                $table->integer('Quantity');
                $table->decimal('Total_Price', 10, 2);
                $table->string('Payment_Method');
                $table->string('Payment_Status');
                $table->timestamps();
    
                $table->foreign('Customer_Id')->references('id')->on('customers');
                $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
