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
                'Customer_Id' => 1,
                'Customer_Fname' => 'Keitt',
                'Customer_Lname' => 'Limited',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Customer_Id' => 2,
                'Customer_Fname' => 'Romwa',
                'Customer_Lname' => 'Ltd',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Add more customer entries as needed
        ];

        DB::table('customers')->insert($customers);
    }
}
