<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $semesterIds = \App\Models\Semester::pluck('id')->toArray();

        return [
            'semester_id' => fake()->randomElement($semesterIds),
            'balance' => fake()->randomFloat(2, 100, 50000),
            'teacher_motivation_amount' => fake()->randomFloat(2, 100, 50000),
            'pta_amount' => fake()->randomFloat(2, 100, 50000),
        ];
    }
}
