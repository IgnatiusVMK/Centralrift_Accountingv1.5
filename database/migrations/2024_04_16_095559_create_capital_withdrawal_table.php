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
        Schema::create('capital_withdrawal', function (Blueprint $table) {
            $table->id();
            $table->string('Capt_Withdraw_Id');
            $table->string('Description');
            $table->integer('Amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capital_withdrawal');
    }
};
