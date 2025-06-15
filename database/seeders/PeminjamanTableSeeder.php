<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('peminjaman')->insert([
            [
                'user_id' => 2,
                'buku_id' => 10,
                'tanggal_pinjam' => '2025-06-15',
                'tanggal_kembali' => '2025-06-15',
                'status' => 'dikembalikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'buku_id' => 7,
                'tanggal_pinjam' => '2025-06-15',
                'tanggal_kembali' => '',
                'status' => 'dipinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}