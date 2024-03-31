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
            ['Department_Name' => 'Administrator', 'Created_Date' => now()],
            ['Department_Name' => 'Executive', 'Created_Date' => now()],
            ['Department_Name' => 'Management', 'Created_Date' => now()],
            ['Department_Name' => 'ICT Operations', 'Created_Date' => now()],
            ['Department_Name' => 'Operations', 'Created_Date' => now()],
            ['Department_Name' => 'Sales & Marketing', 'Created_Date' => now()],
            ['Department_Name' => 'NOT ASSIGNED', 'Created_Date' => now()],
        ];

        DB::table('departments')->insert($departments);
    }
}
