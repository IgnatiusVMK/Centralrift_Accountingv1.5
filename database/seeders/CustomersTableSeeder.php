<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'id' => 1,
                'Customer_Name' => 'Spisa Herbs LTD',
                'Cust_Account_No' => 5845225,
                'Address' => 'Airport RD',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'Customer_Name' => 'Keitt Fresh LTD',
                'Cust_Account_No' => 4785265,
                'Address' => 'Mombasa Road',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('customers')->insert($customers);
    }
}
