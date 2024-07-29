<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'Id' => 1,
                'Customer_Id' => 1,
                'Email' => 'keitt.ltd@domain.org',
                'Contact' => '254712345678',
                'Address' => '123 Kiambu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Id' => 2,
                'Customer_Id' => 2,
                'Email' => 'romwa.ltd@domain.org',
                'Contact' => '254712345678',
                'Address' => '456 Nairobi',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('customer_contacts')->insert($contacts);
    }
}
