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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('Stock_Name');
            $table->integer('Total_Quantity');
            $table->integer('Remaining_Quantity');
            $table->string('Status')->default('pending');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->unsignedBigInteger('maker_id')->nullable();
            $table->timestamps(); // Created_at, Updated_at

            $table->foreign('id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('checker_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
