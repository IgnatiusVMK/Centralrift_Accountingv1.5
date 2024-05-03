<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'Name'=> 'view_users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'create_users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'modify_users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'delete_users',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'Name'=> 'view_finance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'create_finance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'modify_finance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'delete_finance',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'Name'=> 'view_sales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'create_sales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'modify_sales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'delete_sales',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'Name'=> 'view_operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'create_operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'modify_operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'delete_operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            
        ];

        DB::table('permissions')->insert($permissions);
    }
}
