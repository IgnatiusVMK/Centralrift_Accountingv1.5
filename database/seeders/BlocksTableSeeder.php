<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocksTableSeeder extends Seeder
{
    public function run()
    {
        $blocks = [
            'NULL',
            'Block A1',
            'Block A2', 
            'Block A3', 
            'Block A4', 
            'Block A5', 
            'Block A6',
            'House 1',
            'House 2',
            'House 3',
            'House 4',
        ];

        foreach ($blocks as $block) {
            DB::table('blocks')->insert([
                'Block_Name' => $block,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
