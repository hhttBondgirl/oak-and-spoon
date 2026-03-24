<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'name' => $name,
            'slug' => fake()->unique()->slug(2),
            'price' => fake()->numberBetween(300, 1200),
            'image' => 'placeholder.png',
            'description' => fake()->sentence(),
            'type' => fake()->randomElement(['drink', 'food']),
            'spiciness' => fake()->randomElement(['hot', 'ice', '1', '2', '3']),
        ];
    }
}
