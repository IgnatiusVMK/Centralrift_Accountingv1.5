<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'Name'=> 'access_users',
            ],
            [
                'Name'=> 'view_users',
            ],
            [
                'Name'=> 'create_users',
            ],
            [
                'Name'=> 'modify_users',
            ],
            [
                'Name'=> 'delete_users',
            ],

            [
                'Name'=> 'access_cycles',
            ],
            [
                'Name'=> 'view_cycles',
            ],
            [
                'Name'=> 'create_cycles',
            ],

            [
                'Name'=> 'view_finance',
            ],
            [
                'Name'=> 'create_finance',
            ],
            [
                'Name'=> 'modify_finance',
            ],
            [
                'Name'=> 'delete_finance',
            ],

            [
                'Name'=> 'access_sales',
            ],
            [
                'Name'=> 'view_sales',
            ],
            [
                'Name'=> 'create_sales',
            ],
            [
                'Name'=> 'modify_sales',
            ],
            [
                'Name'=> 'delete_sales',
            ],

            [
                'Name'=> 'view_operations',
            ],
            [
                'Name'=> 'create_operations',
            ],
            [
                'Name'=> 'modify_operations',
            ],
            [
                'Name'=> 'delete_operations',
            ],

            [
                'Name'=> 'view_reports',
            ],
            [
                'Name'=> 'create_reports',
            ],
            [
                'Name'=> 'modify_reports',
            ],
            [
                'Name'=> 'delete_reports',
            ],
            
            
        ];

        DB::table('permissions')->insert($permissions);
    }
}
