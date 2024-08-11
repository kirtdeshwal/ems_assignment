<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'adminuser@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('welcome@123'),
                'role_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'first_name' => 'Finance',
                'last_name' => 'User',
                'email' => 'financeuser@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('welcome@123'),
                'role_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
