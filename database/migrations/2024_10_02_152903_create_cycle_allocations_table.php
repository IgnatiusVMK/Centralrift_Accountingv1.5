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
        Schema::create('cycle_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('Cycle_Id');
            $table->unsignedBigInteger('stock_id');
            $table->decimal('allocated_quantity', 10, 2);
            $table->date('allocation_date');
            $table->decimal('remaining_quantity', 10, 2)->default(0); // Remaining quantity in this allocation (if partially used)
            $table->string('Status')->default('pending');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->unsignedBigInteger('maker_id')->nullable();
            $table->timestamps();

            $table->index('Cycle_Id');

            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
            $table->foreign('stock_id')->references('id')->on('stocks');
            $table->foreign('checker_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycle_allocations');
    }
};
