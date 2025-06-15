<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(3),
            'pengarang' => $this->faker->name,
            'penerbit' => $this->faker->company,
            'tahun_terbit' => $this->faker->year,
            'stok' => $this->faker->numberBetween(1, 20),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}