<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'Product_Id' => 1,
                'Product_Name' => 'F/Beans',
                'Description' => 'Fine Beans',
                'Price' => 80.00,
                'Category_Id' => 2,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 2,
                'Product_Name' => 'Tomatoes',
                'Description' => 'An excellent determinate tomato with perfect oval shape- wilt tolerant variety',
                'Price' => 00.00,
                'Category_Id' => 2,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 3,
                'Product_Name' => 'Melon',
                'Description' => 'A superior watermelon with high yield and excellent storage ability',
                'Price' => 00.00,
                'Category_Id' => 2,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 4,
                'Product_Name' => 'Coriander',
                'Description' => 'A sweet aromatic flavor and smell',
                'Price' => 00.00,
                'Category_Id' => 2,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 5,
                'Product_Name' => 'Capsicum',
                'Description' => 'Bell Pepper(Green, Red and Yellow)',
                'Price' => 00.00,
                'Category_Id' => 2,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 6,
                'Product_Name' => 'Basil',
                'Description' => 'Aroma Type',
                'Price' => 300.00,
                'Category_Id' => 1,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 7,
                'Product_Name' => 'Tarragon',
                'Description' => 'Bushy Aromatic Herb',
                'Price' => 380.00,
                'Category_Id' => 1,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 8,
                'Product_Name' => 'Oregano',
                'Description' => 'Oregano',
                'Price' => 320.00,
                'Category_Id' => 1,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 9,
                'Product_Name' => 'Marjoram',
                'Description' => 'Marjoram',
                'Price' => 350.00,
                'Category_Id' => 1,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 10,
                'Product_Name' => 'Lovage',
                'Description' => 'Lovage',
                'Price' => 00.00,
                'Category_Id' => 1,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 11,
                'Product_Name' => 'Thyme',
                'Description' => 'Thyme',
                'Price' => 300.00,
                'Category_Id' => 1,
                'Supplier_Id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 12,
                'Product_Name' => 'Eggs',
                'Description' => 'Layers & Kienyeji',
                'Price' => 500.00,
                'Category_Id' => 3,
                'Supplier_Id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Product_Id' => 13,
                'Product_Name' => 'White Meat',
                'Description' => 'Poultry: Chicken',
                'Price' => 500.00,
                'Category_Id' => 3,
                'Supplier_Id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('products')->insert($products);
    }
}
