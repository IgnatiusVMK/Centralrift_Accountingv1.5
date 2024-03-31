<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'Category_Id' => 1,
                'Category_Name' => 'Herbs & Spices',
                'Description' => 'Ornamental, Aromatic, Medicinal',
                'Created_Date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Category_Id' => 2,
                'Category_Name' => 'Farm Crop Produce',
                'Description' => 'Vegetables, Fruits',
                'Created_Date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Category_Id' => 3,
                'Category_Name' => 'Animal Produce',
                'Description' => 'Eggs, Poultry',
                'Created_Date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
