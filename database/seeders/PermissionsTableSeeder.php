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

            // SuperAdmin Permissions for UserModel
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

            //Permissions for checker
            [
                'Name'=> 'access_checker',
            ],
            [
                'Name'=> 'view_checker',
            ],
            [
                'Name'=> 'create_checker',
            ],
            // Permissions for Maker
            [
                'Name'=> 'access_maker',
            ],
            [
                'Name'=> 'view_maker',
            ],
            [
                'Name'=> 'create_maker',
            ],

            // Permissions for Cycles
            [
                'Name'=> 'access_cycles',
            ],
            [
                'Name'=> 'view_cycles',
            ],
            [
                'Name'=> 'create_cycles',
            ],

            // Permissions for Roles-Model
            [
                'Name'=> 'access_roles',
            ],
            [
                'Name'=> 'view_roles',
            ],
            [
                'Name'=> 'create_roles',
            ],
            // Permissions for Permissions-Model
            [
                'Name'=> 'access_permissions',
            ],
            [
                'Name'=> 'view_permissions',
            ],
            [
                'Name'=> 'create_permissions',
            ],

            // Permissions for Master-Operations
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
            
            // Permissions for Customers
            [
                'Name'=> 'access_customers',
            ],
            [
                'Name'=> 'view_customers',
            ],
            [
                'Name'=> 'create_customers',
            ],
            [
                'Name'=> 'modify_customers',
            ],
            [
                'Name'=> 'delete_customers',
            ],

            // Permissions for Monthly Expenses
            [
                'Name'=> 'access_analytics_summaries',
            ],
            [
                'Name'=> 'view_analytics_summaries',
            ],
            [
                'Name'=> 'create_analytics_summaries',
            ],
            [
                'Name'=> 'modify_analytics_summaries',
            ],
            [
                'Name'=> 'delete_analytics_summaries',
            ],

            // Permissions for purchases
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

            // Permissions for Sales Model
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

            // Permissions for Finance Model (Cashbook, P&L)
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

            //  InventoryModel
            [
                'Name'=> 'access_stock',
            ],
            [
                'Name'=> 'view_stock',
            ],
            [
                'Name'=> 'create_stock',
            ],
            [
                'Name'=> 'modify_stock',
            ],
            [
                'Name'=> 'delete_stock',
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

            //Permissions for System Maintenance
            [
                'Name'=> 'access_maintenance',
            ],
            [
                'Name'=> 'view_maintenance',
            ],
            [
                'Name'=> 'create_maintenance',
            ],

            
        ];

        DB::table('permissions')->insert($permissions);
    }
}
