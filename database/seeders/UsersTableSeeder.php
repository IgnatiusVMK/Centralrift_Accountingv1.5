<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'System Administrator',
                'email' => 'sysadmin@domain.org',
                /* 'email' => 'ivmkariuki@gmail.com', */
                'is_active' => true,
                'role' => 'System Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ignatius Victor',
                'email' => 'ignatiusvmk@domain.org',
                /* 'email' => 'ivmkariuki@gmail.com', */
                'is_active' => true,
                'role' => 'ICT Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Mwai',
                'email' => 'mmwai@domain.org',
                /* 'email' => 'ivmkariuki@gmail.com', */
                'is_active' => true,
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lydiah Gichuki',
                'email' => 'lgichuki@domain.org',
                /* 'email' => 'ivmkariuki@gmail.com', */
                'is_active' => true,
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Zackary Gichuki',
                /* 'email' => 'zgichuki@domain.org', */
                'email' => 'ivmkariuki@gmail.com',
                'is_active' => true, //false
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
