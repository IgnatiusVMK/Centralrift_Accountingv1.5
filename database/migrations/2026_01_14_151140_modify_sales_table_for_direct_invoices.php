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
        Schema::table('sales', function (Blueprint $table) {
            // Make Cycle_Id nullable to support direct invoices
            $table->string('Cycle_Id')->nullable()->change();
            
            // Make Harvest_Id nullable (harvest requires cycle)
            $table->unsignedBigInteger('Harvest_Id')->nullable()->change();
            
            // Add source tracking: 'cycle-based' or 'direct'
            $table->enum('invoice_source', ['cycle-based', 'direct'])->default('cycle-based')->after('Status');
            
            // Add invoice_id to link back to invoices table (for direct invoices)
            $table->foreignId('invoice_id')->nullable()->after('Sales_Id')->constrained('invoices')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // Remove invoice_id foreign key
            $table->dropForeign(['invoice_id']);
            $table->dropColumn('invoice_id');
            
            // Remove invoice_source
            $table->dropColumn('invoice_source');
            
            // Revert Cycle_Id and Harvest_Id to not nullable (if needed)
            // Note: This may fail if there are null values, so handle carefully
            // $table->string('Cycle_Id')->nullable(false)->change();
            // $table->unsignedBigInteger('Harvest_Id')->nullable(false)->change();
        });
    }
};
