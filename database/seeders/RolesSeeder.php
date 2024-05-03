<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'Name'=> 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'Finance Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'Finance Officer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'Sales Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'Sales Officer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'Operations Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name'=> 'Operations Officer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        DB::table('roles')->insert($roles);
    }
}
