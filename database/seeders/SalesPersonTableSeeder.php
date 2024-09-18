<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesPersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $salesperson = [
            [
                'id' => 1,
                'first_name' => 'John',
                'last_name' => 'Kamau',
                'email' => 'j.kamau@spisa.com',
                'phone' => '254712345678',
            ],
            [
                'id' => 2,
                'first_name' => 'Peter',
                'last_name' => 'Ngure',
                'email' => 'p.ngure@spisa.com',
                'phone' => '254712345678',
            ],
            [
                'id' => 3,
                'first_name' => 'Maina',
                'last_name' => 'KImani',
                'email' => 'm.kimani@keittltd.com',
                'phone' => '254712345678',
            ]
            ];
            DB::table('salespersons')->insert($salesperson);
    }
}
