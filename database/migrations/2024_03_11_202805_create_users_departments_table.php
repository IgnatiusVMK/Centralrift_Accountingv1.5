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
        Schema::create('users_departments', function (Blueprint $table) {
            $table->id('user_department_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id')->default(6);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_departments');
    }
};
