<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'Supplier_Id' => 1,
                'Supplier_Name' => 'Alliance Agrovet',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Supplier_Id' => 2,
                'Supplier_Name' => 'Empress',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Supplier_Id' => 3,
                'Supplier_Name' => 'Farmers Desk',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Supplier_Id' => 4,
                'Supplier_Name' => 'Afrodrip',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Supplier_Id' => 5,
                'Supplier_Name' => 'Jim Packaging',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}
