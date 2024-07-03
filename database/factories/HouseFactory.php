<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $houseNames = [
            'Cardinal Appiah Turkson',
            'Bishop Afrifa Agyekum',
            'Archbishop Palmer Buckle',
            'Bishop Gabriel Eddoe Kumordzie',
            'White House',
        ];

        return [
            'name' => fake()->unique()->randomElement($houseNames),
        ];
    }
}
