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
        Schema::create('chemicals', function (Blueprint $table) {
            $table->bigIncrements('Chemical_Id');
            $table->string('Chemical_Name');
            $table->decimal('Quantity', 10, 2);
            $table->string('Cycle_Id');
            $table->timestamps();

            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chemicals');
    }
};
