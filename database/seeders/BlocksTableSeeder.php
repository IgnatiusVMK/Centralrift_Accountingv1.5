<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocksTableSeeder extends Seeder
{
    public function run()
    {
        $blocks = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6'];

        foreach ($blocks as $block) {
            DB::table('blocks')->insert([
                'Block_Name' => 'Block ' . $block,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
