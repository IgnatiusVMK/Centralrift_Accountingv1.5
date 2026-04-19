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
        Schema::create('customer_salesperson', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Use singular 'customer_id'
            $table->unsignedBigInteger('sales_person_id'); // Ensure this matches the column name
            $table->timestamps();
            
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('sales_person_id')->references('id')->on('salespersons')->onDelete('cascade');
            
            // To ensure a unique relationship per customer and salesperson
            $table->unique(['customer_id', 'sales_person_id']); // Correct column name
        });
              
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_salesperson');
    }
};
