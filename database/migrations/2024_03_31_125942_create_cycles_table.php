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
        Schema::create('cycles', function (Blueprint $table) {
            $table->id('Cycle_Id');
            $table->unsignedInteger('Block_Id');
            $table->string('Cycle_Name');
            $table->dateTime('Created_Date');
            $table->timestamps();

            $table->foreign('Block_Id')->references('Block_Id')->on('blocks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
