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
        Schema::create('products_sales', function (Blueprint $table) {
            $table->id('Products_Sales_Id');
            $table->unsignedBigInteger('Product_Id');
            $table->unsignedBigInteger('Sales_Id');
            $table->string('Cycle_Id');

            $table->foreign('Product_Id')->references('Product_Id')->on('products');
            $table->foreign('Sales_Id')->references('id')->on('sales');
            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_sales');
    }
};
