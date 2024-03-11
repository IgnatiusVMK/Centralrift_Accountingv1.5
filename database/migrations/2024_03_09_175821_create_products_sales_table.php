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
            $table->id('products_sales_Id');
            $table->unsignedBigInteger('Product_Id');
            $table->unsignedBigInteger('Sales_Id');
            $table->timestamps();
        
            $table->foreign('Product_Id')->references('Product_Id')->on('products');
            $table->foreign('Sales_Id')->references('Sales_Id')->on('sales');
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
