<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users_departments')->insert([
            [
                'user_id' => 1,
                'Department_Id' => 1,
            ],
            [
                'user_id' => 2,
                'Department_Id' => 4,
            ],
            [
                'user_id' => 3,
                'Department_Id' => 2,
            ],
            [
                'user_id' => 4,
                'Department_Id' => 3,
            ],
            [
                'user_id' => 5,
                'Department_Id' => 5,
            ],
        ]);
    }
}
