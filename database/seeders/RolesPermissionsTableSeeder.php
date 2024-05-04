<?php

namespace Database\Seeders;

use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //This Seeder attaches/assigns default permissions to the different roles 
    public function run(): void
    {

        $adminRole = Roles::where('Name', 'Admin')->first();

        $permissions = Permissions::all();

        foreach ($permissions as $permission) {
            $adminRole->permissions()->attach($permission);
        }

    }
}
