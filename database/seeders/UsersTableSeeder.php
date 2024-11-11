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
                'email' => 'sys-administrator@centralriftfpkl.com',
                'is_active' => true,
                'role' => 'System Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('sysadmin@centralriftfpkl.com'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => false,
            ],
            [
                'name' => 'Ignatius Victor',
                'email' => 'ignatiusvmk@centralriftfpkl.com',
                'is_active' => true,
                'role' => 'ICT Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('ignatiusvmk@centralriftfpkl.com'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
            [
                'name' => 'Michael Mwai',
                'email' => 'mmwai@centralriftfpkl.com',
                'is_active' => true,
                'role' => 'Manager',
                'email_verified_at' => now(),
                'password' => Hash::make('mmwai@centralriftfpkl.com'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
            [
                'name' => 'Lydiah Gichuki',
                'email' => 'lgichuki@centralriftfpkl.com',
                'is_active' => true,
                'role' => 'Manager',
                'email_verified_at' => now(),
                'password' => Hash::make('lgichuki@centralriftfpkl.com'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
            [
                'name' => 'Zackary Gichuki',
                'email' => 'zgichuki@centralriftfpkl.com',
                'is_active' => true, //false
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => Hash::make('zgichuki@centralriftfpkl.com'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
        ]);
    }
}
