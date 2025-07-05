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
        Schema::table('customers', function (Blueprint $table) {
            
            $table->string('AttentionTo', 255)->nullable()->after('Customer_Name');

            $table->string('AddressLine1', 255)->nullable()->after('Address');
            $table->string('AddressLine2', 255)->nullable()->after('AddressLine1');
            $table->string('City', 100)->nullable()->after('AddressLine2');
            $table->string('Region_State', 100)->nullable()->after('City');
            $table->string('PostalCode', 20)->nullable()->after('Region_State'); // Use string for postal codes
            $table->string('Country', 100)->nullable()->after('PostalCode');

            // Optionally, if you plan to completely deprecate the old 'Address' column later,
            // you might consider making it nullable here if it's not already,
            // though your schema shows it's already VARCHAR(255) which implies it can be empty string.
            // If it could be NOT NULL and had a default, you might use ->change() here.
            // $table->string('Address', 255)->nullable()->change(); // Requires doctrine/dbal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Drop the new columns in reverse order of how they were added (good practice)
            $table->dropColumn([
                'AttentionTo',
                'AddressLine1',
                'AddressLine2',
                'City',
                'Region_State',
                'PostalCode',
                'Country',
            ]);
        });
    }
};
