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
        //Admin Permissions
        $adminRole = Roles::where('Name', 'Admin')->first();

        $adminpermissions = Permissions::all();

        foreach ($adminpermissions as $adminpermission) {
            $adminRole->permissions()->attach($adminpermission);
        }

        //Executive Permissions
        /* $executivePermissions = [
            'access_users',
            'view_users',
            'create_users',
            'access_approval',
            'view_approval',
            'create_approval',
            'access_cycles',
            'view_cycles',
            'create_cycles',
            'access_master',
            'view_master',
            'create_master',
            'modify_master',
            'delete_master',
            'access_financials',
            'view_financials',
            'create_financials',
            'modify_financials',
            'delete_financials',
            'access_purchases',
            'view_purchases',
            'create_purchases',
            'modify_purchases',
            'delete_purchases',
            'access_sales',
            'view_sales',
            'create_sales',
            'modify_sales',
            'delete_sales',
            'access_finance',
            'view_finance',
            'create_finance',
            'modify_finance',
            'delete_finance',
            'access_reports',
            'view_reports',
            'create_reports',
        ];

        $executiveRole = Roles::where('Name', 'Executive')->first();

        foreach ($executivePermissions as $executivePermissionName) {
            $execpermission = Permissions::where('Name', $executivePermissionName)->first();
            if ($execpermission) {
                $executiveRole->permissions()->attach($execpermission);
            }
        } */

        //Management Permissions
        /* $managerPermissions = [
            'access_maker',
            'view_maker',
            'create_maker',
            'access_cycles',
            'view_cycles',
            'create_cycles',
            'access_master',
            'view_master',
            'create_master',
            'access_financials',
            'view_financials',
            'create_financials',
            'access_purchases',
            'view_purchases',
            'create_purchases',
            'access_sales',
            'view_sales',
            'create_sales',
            'access_finance',
            'view_finance',
            'create_finance',
            'access_reports',
            'view_reports',
            'create_reports',
        ];

        $managerRole = Roles::where('Name', 'Management')->first();

        foreach ($managerPermissions as $managerPermissionName) {
            $mngpermission = Permissions::where('Name', $managerPermissionName)->first();
            if ($mngpermission) {
                $managerRole->permissions()->attach($mngpermission);
            }
        }
 */
    }
}
