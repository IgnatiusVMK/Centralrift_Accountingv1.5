<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierContactsTableSeeder extends Seeder
{
    public function run()
    {
        $contacts = [
            [
                'Supplier_Contact_Id' => 1,
                'Supplier_Id' => 1,
                'Contact_Name' => 'John Doe',
                'Address' => '123 Main St',
                'Phone' => 254712345678,
                'Email' => 'john.allianceagrovets@domain.org',
                'Created_Date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Supplier_Contact_Id' => 2,
                'Supplier_Id' => 2,
                'Contact_Name' => 'Jane Smith',
                'Address' => '456 Elm St',
                'Phone' => 254712345678,
                'Email' => 'jane.empress@domain.org',
                'Created_Date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Supplier_Contact_Id' => 3,
                'Supplier_Id' => 3,
                'Contact_Name' => 'Jane Smith',
                'Address' => '456 Elm St',
                'Phone' => 254712345678,
                'Email' => 'jane.farmersdesk@domain.org',
                'Created_Date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Supplier_Contact_Id' => 4,
                'Supplier_Id' => 4,
                'Contact_Name' => 'Jane Smith',
                'Address' => '456 Elm St',
                'Phone' => 254712345678,
                'Email' => 'jane.afrodrip@domain.org',
                'Created_Date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Supplier_Contact_Id' => 5,
                'Supplier_Id' => 5,
                'Contact_Name' => 'Jane Smith',
                'Address' => '456 Elm St',
                'Phone' => 254712345678,
                'Email' => 'jane.jimpackaging@domain.org',
                'Created_Date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Add more contact entries as needed
        ];

        DB::table('supplier_contacts')->insert($contacts);
    }
}
