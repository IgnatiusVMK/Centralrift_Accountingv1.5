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
        Schema::create('supplier_contacts', function (Blueprint $table) {
            $table->id('Supplier_Contact_Id');
            $table->unsignedBigInteger('Supplier_Id');
            $table->string('Contact_Name', 255);
            $table->string('Address', 255);
            $table->string('Phone', 255);
            $table->string('Email', 255);
            $table->dateTime('Created_Date');
            $table->timestamps();

            $table->foreign('Supplier_Id')->references('Supplier_Id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_contacts');
    }
};
