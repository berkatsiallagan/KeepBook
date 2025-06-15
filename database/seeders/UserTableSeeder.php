<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password' => md5('admin123'),
                'nama' => 'Administrator',
                'role' => 'admin',
                'created_at' => now(),
            ],
            [
                'username' => 'Berkat',
                'password' => md5('123456'),
                'nama' => 'Berkat Tua Siallagan',
                'role' => 'client',
                'created_at' => now(),
            ]
        ]);
    }
}