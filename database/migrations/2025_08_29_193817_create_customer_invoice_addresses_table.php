<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer_invoice_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('ship_AddressLine1')->nullable();
            $table->string('ship_AddressLine2')->nullable();
            $table->string('ship_City')->nullable();
            $table->string('ship_Region_State')->nullable();
            $table->string('ship_PostalCode')->nullable();
            $table->string('ship_Country')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_invoice_addresses');
    }
};
