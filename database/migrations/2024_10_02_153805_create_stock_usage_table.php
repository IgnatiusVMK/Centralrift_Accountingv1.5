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
        Schema::create('stock_usages', function (Blueprint $table) {
            $table->id();
            $table->string('Cycle_Id');
            $table->unsignedBigInteger('Allocation_Id');
            $table->integer('quantity_used'); // Quantity used from this allocation
            $table->date('usage_date'); // Date when the stock was used
            $table->string('Status')->default('pending');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->unsignedBigInteger('maker_id')->nullable();
            $table->timestamps();

            $table->index('Cycle_Id');

            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
            $table->foreign('Allocation_Id')->references('id')->on('cycle_allocations');
            $table->foreign('checker_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_usage');
    }
};
