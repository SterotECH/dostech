<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SemesterDues>
 */
class SemesterDuesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'semester_id' => \App\Models\Semester::factory(),
            'total_dues' => fake()->randomFloat(2, 100, 1000),
            'pta_percentage' => 40,
            'teacher_motivation_percentage' => 60,
        ];
    }
}
