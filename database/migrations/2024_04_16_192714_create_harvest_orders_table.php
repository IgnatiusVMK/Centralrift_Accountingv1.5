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
            $table->string('Cycle_Id');
            $table->string('company_name')->nullable();
            $table->string('product_name');
            $table->date('order_date');
            $table->date('planting_date');
            $table->date('harvest_date');
            $table->timestamps();

            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
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
