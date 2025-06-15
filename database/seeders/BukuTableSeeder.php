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
            [
                'judul' => 'Database MySQL untuk Pemula',
                'pengarang' => 'Budi Santoso',
                'penerbit' => 'Elex Media',
                'tahun_terbit' => 2019,
                'stok' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Algoritma dan Struktur Data',
                'pengarang' => 'Dian Pramana',
                'penerbit' => 'Pustaka Pelajar',
                'tahun_terbit' => 2018,
                'stok' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Machine Learning Sederhana',
                'pengarang' => 'Yuni Astuti',
                'penerbit' => 'Andi Publisher',
                'tahun_terbit' => 2022,
                'stok' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kecerdasan Buatan Modern',
                'pengarang' => 'Fahri Ramadhan',
                'penerbit' => 'Deepublish',
                'tahun_terbit' => 2023,
                'stok' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Desain UI/UX Web',
                'pengarang' => 'Rika Melati',
                'penerbit' => 'Media Komputindo',
                'tahun_terbit' => 2020,
                'stok' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pemrograman Java Lanjut',
                'pengarang' => 'Fajar Nugroho',
                'penerbit' => 'Salemba Empat',
                'tahun_terbit' => 2017,
                'stok' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Jaringan Komputer',
                'pengarang' => 'Lukman Hakim',
                'penerbit' => 'Prenada Media',
                'tahun_terbit' => 2016,
                'stok' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Analisis Sistem Informasi',
                'pengarang' => 'Sari Dewi',
                'penerbit' => 'Universitas Terbuka',
                'tahun_terbit' => 2021,
                'stok' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);        
    }
}