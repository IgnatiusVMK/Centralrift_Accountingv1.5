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

        $sys_admin_name = env('SYS_ADMIN_NAME');
        $sys_admin_email = env('SYS_ADMIN_EMAIL');
        $sys_admin_password = env('SYS_ADMIN_PWD');

        $user1_name = env('USER_1_NAME');
        $user1_email = env('USER_1_EMAIL');
        $user1_pwd = env('USER_1_PWD');

        $user2_name = env('USER_2_NAME');
        $user2_email = env('USER_2_EMAIL');
        $user2_pwd = env('USER_2_PWD');

        $user3_name = env('USER_3_NAME');
        $user3_email = env('USER_3_EMAIL');
        $user3_pwd = env('USER_3_PWD');

        $user4_name = env('USER_4_NAME');
        $user4_email = env('USER_4_EMAIL');
        $user4_pwd = env('USER_4_PWD');

        DB::table('users')->insert([
            [
                'name' => $sys_admin_name,
                'email' => $sys_admin_email,
                'is_active' => true,
                'role' => 'System Admin',
                'email_verified_at' => now(),
                'password' => Hash::make($sys_admin_password),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => false,
            ],
            [
                'name' => $user1_name,
                'email' => $user1_email,
                'is_active' => true,
                'role' => 'ICT Admin',
                'email_verified_at' => now(),
                'password' => Hash::make($user1_pwd),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => false,
            ],
            [
                'name' => $user2_name,
                'email' => $user2_email,
                'is_active' => true,
                'role' => 'Manager',
                'email_verified_at' => now(),
                'password' => Hash::make($user2_pwd),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
            [
                'name' => $user3_name,
                'email' => $user3_email,
                'is_active' => false,
                'role' => 'Manager',
                'email_verified_at' => now(),
                'password' => Hash::make($user3_pwd),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => false,
            ],
            [
                'name' => $user4_name,
                'email' => $user4_email,
                'is_active' => false, //false
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => Hash::make($user4_pwd),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'otp_enabled' => true,
            ],
        ]);
    }
}
