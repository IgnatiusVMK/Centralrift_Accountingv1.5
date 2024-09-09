<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /* public function up(): void
    {
        Schema::create('customer_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Customer_Id');
            $table->foreign('Customer_Id')->references('Customer_Id')->on('customers')->onDelete('cascade');
            $table->string('Email', 255);
            $table->string('Contact', 255);
            $table->string('Address', 255);
            $table->timestamps();
        });
    } */

    /**
     * Reverse the migrations.
     */
    /* public function down(): void
    {
        Schema::dropIfExists('customer_contacts');
    } */
};
