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
        if (!Schema::hasTable('sales')) {
            Schema::create('sales', function (Blueprint $table) {
                $table->id();
                $table->string('Sales_Id')->unique();
                $table->unsignedBigInteger('Customer_Id');
                $table->string('Cycle_Id');
                $table->string('Lpo_No');
                $table->date('Sale_Date');
                $table->integer('Net_Weight');
                $table->decimal('Total_Price', 10, 2);
                /* $table->string('Payment_Method')->nullable(); */
                $table->string('Payment_Status');
                $table->string('packaging_option');
                $table->string('Description')->nullable();
                $table->decimal('No_of_boxes', 10, 2)->nullable();
                $table->string('Status')->default('pending');
                $table->unsignedBigInteger('checker_id')->nullable();
                $table->unsignedBigInteger('maker_id')->nullable();
                $table->timestamps();

                $table->foreign('checker_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('maker_id')->references('id')->on('users')->onDelete('cascade');

                // Foreign key constraints (assuming you have users and customers tables)
                $table->foreign('Customer_Id')->references('id')->on('customers')->onDelete('cascade');
                $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
