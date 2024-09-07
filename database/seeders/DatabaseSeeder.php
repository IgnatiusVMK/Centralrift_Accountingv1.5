<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            BlocksTableSeeder::class,
            CategoriesTableSeeder::class,
            CustomersTableSeeder::class,
            CustomerContactsTableSeeder::class,
            DepartmentsTableSeeder::class,
            SuppliersTableSeeder::class,
            SupplierContactsTableSeeder::class,
            ProductsTableSeeder::class,
            UsersTableSeeder::class,
            UserDepartmentSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesPermissionsTableSeeder::class,
            RoleUserSeeder::class,
            /* TestCycleSeeders::class, */
        ]);
    }
}
