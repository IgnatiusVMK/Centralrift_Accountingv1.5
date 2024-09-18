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
        Schema::create('scheduled_maintenances', function (Blueprint $table) {
            $table->id();
            $table->timestamp('scheduled_at')->nullable();  // Time for scheduled maintenance
            $table->boolean('is_completed')->default(false);  // Flag to check if maintenance has been completed
            $table->unsignedBigInteger('maker_id')->nullable();
            $table->timestamps();

            $table->foreign('maker_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('scheduled_maintenances');
    }
};
