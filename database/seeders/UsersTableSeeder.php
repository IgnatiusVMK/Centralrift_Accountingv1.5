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
                'name' => 'CentralriftFPKL Admin',
                'email' => 'sys-administrator@centralriftfpkl.com',
                'is_active' => true,
                'role' => 'System Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('CMCDa%js3^3QZ8*ZN5^osz@Qf'),
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
                'password' => Hash::make('^3xs6l%hS7&9vMD@&o'),
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
                'password' => Hash::make('ZKn&46hhiZEtG*84X*'),
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
                'password' => Hash::make('v5E7^&6McTJKGu^q!j'),
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
                'password' => Hash::make('Rx&u!AMQzRb7H4!749'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
        ]);
    }
}
