<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //This Seeder Assigns roles to Users
        $roleuser = [
            [
                "user_id" => 1,
                "role_id" => 1,
            ],
            [
                "user_id" => 2,
                "role_id" => 1,
            ],
            [
                "user_id" => 3,
                "role_id" => 2,
            ],
            [
                "user_id" => 4,
                "role_id" => 3,
            ]
        ];

        DB::table('role_user')->insert($roleuser);
    }
}
