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
                'department_Id' => 1,
            ],
            [
                'user_id' => 2,
                'department_Id' => 5,
            ],
            [
                'user_id' => 3,
                'department_Id' => 3,
            ],
            [
                'user_id' => 4,
                'department_Id' => 4,
            ],
            [
                'user_id' => 5,
                'department_Id' => 6,
            ],
            [
                'user_id' => 6,
                'department_Id' => 5,
            ],
        ]);
    }
}
