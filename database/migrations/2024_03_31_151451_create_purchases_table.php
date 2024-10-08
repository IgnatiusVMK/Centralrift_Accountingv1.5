<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('Purchase_Id')->unique();
            $table->string('Item_Name');
            $table->unsignedBigInteger('Supplier_Id');
            $table->integer('Category_Id');
            $table->decimal('Quantity',10, 2);
            $table->decimal('Unit_Cost', 10, 2);
            $table->decimal('Total_Cost', 10, 2);
            $table->date('Purchase_Date');
            $table->string('Status')->default('pending');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->unsignedBigInteger('maker_id')->nullable();
            $table->timestamps();

            // $table->index(columns: 'Stock_Id');
            
            $table->foreign('checker_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('users');
            $table->foreign('Supplier_Id')->references('Supplier_Id')->on('suppliers');
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
