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
        Schema::create('customer_product_pricing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->constrained('products', 'Product_Id');
            $table->enum('type', ['proforma', 'commercial']);
            $table->decimal('price', 10, 2);
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->timestamps();

            $table->unique(['customer_id', 'product_id', 'type', 'valid_from'], 'unique_customer_product_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_product_pricing');
    }
};
