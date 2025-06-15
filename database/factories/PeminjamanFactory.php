<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PeminjamanFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'buku_id' => \App\Models\Buku::factory(),
            'tanggal_pinjam' => $this->faker->date(),
            'tanggal_kembali' => $this->faker->optional()->date(),
            'status' => $this->faker->randomElement(['dipinjam', 'dikembalikan']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}