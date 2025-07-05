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
        Schema::create('harvests', function (Blueprint $table) {
            $table->id();
            $table->string('Cycle_Id')->onDelete('cascade');
            $table->string('Product');
            $table->string('Customer_Name');
            $table->date('harvest_date');
            $table->decimal('quantity_harvested',10, 2);
            $table->decimal('quantity_spoilt', 10, 2);
            $table->string('quality_grade')->nullable();
            $table->text('remarks')->nullable();
            $table->string('Status')->default('pending');
            $table->unsignedBigInteger('checker_id')->nullable();
            $table->unsignedBigInteger('maker_id')->nullable();
            $table->timestamps();

            $table->foreign('Cycle_Id')->references('Cycle_Id')->on('cycles');
            $table->foreign('checker_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvests');
    }
};
