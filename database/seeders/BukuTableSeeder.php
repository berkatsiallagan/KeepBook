<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('buku')->insert([
            [
                'judul' => 'Belajar HTML dan CSS',
                'pengarang' => 'Andi Wijaya',
                'penerbit' => 'Informatika',
                'tahun_terbit' => 2020,
                'stok' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pemrograman Python Dasar',
                'pengarang' => 'Rina Kurnia',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2021,
                'stok' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add all other books from the original SQL dump
            // ...
        ]);
    }
}