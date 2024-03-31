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
        Schema::create('seeds', function (Blueprint $table) {
            $table->id('Seed_Id');
            $table->string('Seed_Name');
            $table->decimal('Quantity');
            $table->integer('Cycle_Id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seeds');
    }
};
