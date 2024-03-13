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
        Schema::create('harvest_orders', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('product_name');
            $table->date('order_date');
            $table->date('planting_date');
            $table->date('harvest_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvest_orders');
    }
};
