<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            BukuTableSeeder::class,
            PeminjamanTableSeeder::class,
        ]);
    }
}