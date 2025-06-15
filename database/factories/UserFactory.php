<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => md5('password'), // Using md5 to match the original
            'nama' => $this->faker->name,
            'role' => $this->faker->randomElement(['admin', 'client']),
            'created_at' => now(),
        ];
    }
}