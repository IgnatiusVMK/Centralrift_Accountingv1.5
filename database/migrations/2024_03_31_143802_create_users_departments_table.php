<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_departments', function (Blueprint $table) {
            $table->id('user_department_id');
            $table->unsignedBigInteger('user_id'); // Use unsignedBigInteger to match the users table
            $table->unsignedBigInteger('Department_Id')->default(6);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('Department_Id')->references('id')->on('departments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_department');
    }
};
