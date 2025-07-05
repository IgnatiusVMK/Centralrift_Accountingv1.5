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
        // This migration drops the old 'Address' column
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('Address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is crucial for rollback functionality.
        Schema::table('customers', function (Blueprint $table) {
            $table->string('Address', 255)->nullable(false);
        });
    }
};
