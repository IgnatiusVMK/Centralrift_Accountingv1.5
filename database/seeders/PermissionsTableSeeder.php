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

            //SuperAdmin Permissions for UserModel
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

            //Permissions for Approval
            [
                'Name'=> 'access_approval',
            ],
            [
                'Name'=> 'view_approval',
            ],
            [
                'Name'=> 'create_approval',
            ],
            //Permissions for Maker
            [
                'Name'=> 'access_maker',
            ],
            [
                'Name'=> 'view_maker',
            ],
            [
                'Name'=> 'create_maker',
            ],

            //Permissions for Cycles
            [
                'Name'=> 'access_cycles',
            ],
            [
                'Name'=> 'view_cycles',
            ],
            [
                'Name'=> 'create_cycles',
            ],

            //Permissions for Roles
            [
                'Name'=> 'access_roles',
            ],
            [
                'Name'=> 'view_roles',
            ],
            [
                'Name'=> 'create_roles',
            ],
            //Permissions for Permissions
            [
                'Name'=> 'access_permissions',
            ],
            [
                'Name'=> 'view_permissions',
            ],
            [
                'Name'=> 'create_permissions',
            ],

            //Permissions for Master-Operations
            [
                'Name'=> 'access_master',
            ],
            [
                'Name'=> 'view_master',
            ],
            [
                'Name'=> 'create_master',
            ],
            [
                'Name'=> 'modify_master',
            ],
            [
                'Name'=> 'delete_master',
            ],

            //Permissions for Monthly Expenses
            [
                'Name'=> 'access_financials',
            ],
            [
                'Name'=> 'view_financials',
            ],
            [
                'Name'=> 'create_financials',
            ],
            [
                'Name'=> 'modify_financials',
            ],
            [
                'Name'=> 'delete_financials',
            ],

            //Permissions for purchases
            [
                'Name'=> 'access_purchases',
            ],
            [
                'Name'=> 'view_purchases',
            ],
            [
                'Name'=> 'create_purchases',
            ],
            [
                'Name'=> 'modify_purchases',
            ],
            [
                'Name'=> 'delete_purchases',
            ],

            //Permissions for Sales
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

            //Permissions for Finances (Cashbook, P&L)
            [
                'Name'=> 'access_finance',
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
            
            //Permissions for reports
            [
                'Name'=> 'access_reports',
            ],
            [
                'Name'=> 'view_reports',
            ],
            [
                'Name'=> 'create_reports',
            ],
            
        ];

        DB::table('permissions')->insert($permissions);
    }
}
