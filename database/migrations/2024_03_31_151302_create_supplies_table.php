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
        Schema::create('supplies', function (Blueprint $table) {
            $table->id('Supplies_Id');
            $table->unsignedBigInteger('Product_Id');
            $table->unsignedBigInteger('Supplier_Id');
            $table->decimal('Unit_Price', 10, 2);
            $table->dateTime('Supply_Date');
            $table->integer('Quantity');
            $table->string('Cycle_Id');
            $table->string('Status')->default('pending');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->unsignedBigInteger('maker_id')->nullable();

            $table->foreign('checker_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('users');
            
            $table->foreign('Product_Id')->references('Product_Id')->on('products');
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
        Schema::dropIfExists('supplies');
    }
};
