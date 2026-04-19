<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Customer_SalesPersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $customer_sales_person = [
            [
                'id' => 1,
                'customer_id' => 1,
                'sales_person_id' => 1,
            ],
            [
                'id' => 2,
                'customer_id' => 1,
                'sales_person_id' => 2,
            ],
            [
                'id' => 3,
                'customer_id' => 2,
                'sales_person_id' => 3,
            ],
        ];
        DB::table('customer_salesperson')->insert($customer_sales_person);
    }
}
