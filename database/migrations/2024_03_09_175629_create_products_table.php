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
        Schema::create('products', function (Blueprint $table) {
            $table->id('Product_Id');
            $table->string('Product_Name');
            $table->string('Description')->nullable();
            $table->decimal('Price', 10, 2);
            $table->unsignedBigInteger('Category_Id');
            $table->unsignedBigInteger('Supplier_Id');
            $table->dateTime('Created_Date');
            $table->timestamps();
        
            $table->foreign('Category_Id')->references('Category_Id')->on('categories');
            $table->foreign('Supplier_Id')->references('Supplier_Id')->on('suppliers');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
