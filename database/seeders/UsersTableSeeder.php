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
                /* 'email' => 'sysadmin@domain.org', */
                'email' => 'vmwaikariuki@outlook.com',
                'is_active' => true,
                'role' => 'System Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('sysadmin@domain.org'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => false,
            ],
            [
                'name' => 'Ignatius Victor',
                /* 'email' => 'ignatiusvmk@domain.org', */
                'email' => 'ignatiusvmk@gmail.com',
                'is_active' => true,
                'role' => 'ICT Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('ignatiusvmk@domain.org'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
            [
                'name' => 'Michael Mwai',
                /* 'email' => 'mmwai@domain.org', */
                'email' => 'ivmkariuki@gmail.com',
                'is_active' => true,
                'role' => 'Manager',
                'email_verified_at' => now(),
                'password' => Hash::make('mmwai@domain.org'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
            [
                'name' => 'Lydiah Gichuki',
                /* 'email' => 'lgichuki@domain.org', */
                'email' => 'acadwrittyvmk8@gmail.com',
                'is_active' => true,
                'role' => 'Manager',
                'email_verified_at' => now(),
                'password' => Hash::make('lgichuki@domain.org'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
            [
                'name' => 'Zackary Gichuki',
                /* 'email' => 'zgichuki@domain.org', */
                'email' => 'marleyignacio8@gmail.com',
                'is_active' => true, //false
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => Hash::make('zgichuki@domain.org'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
            [
                'name' => 'Dennis Kainga',
                'email' => 'denniskainga@gmail.com',
                'is_active' => true, //false
                'role' => 'ICT Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('denniskainga@gmail.com'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
        ]);
    }
}
