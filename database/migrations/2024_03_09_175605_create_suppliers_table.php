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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('Supplier_Id');
            $table->string('Supplier_Name');
            $table->string('Contact_Name')->nullable();
            $table->string('Address')->nullable();
            $table->integer('Phone')->nullable();
            $table->string('Email')->nullable();
            $table->dateTime('Created_Date');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};