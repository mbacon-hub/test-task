<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => fake()->word,
            "price" => fake()->randomNumber(4) + 5000,
            "balance" => (mt_rand(1, 50) / 50 > 0.8) ? 0 : fake()->randomNumber(2)
        ];
    }
}
