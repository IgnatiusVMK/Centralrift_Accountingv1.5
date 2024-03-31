<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['Department_Name' => 'Administrator', 'created_at' => now()],
            ['Department_Name' => 'Executive', 'created_at' => now()],
            ['Department_Name' => 'Management', 'created_at' => now()],
            ['Department_Name' => 'ICT Operations', 'created_at' => now()],
            ['Department_Name' => 'Operations', 'created_at' => now()],
            ['Department_Name' => 'Sales & Marketing', 'created_at' => now()],
            ['Department_Name' => 'NOT ASSIGNED', 'created_at' => now()],
        ];

        DB::table('departments')->insert($departments);
    }
}
