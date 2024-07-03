<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startYear = fake()->unique()->numberBetween(2020, 2024);
        $startDate = $startYear . '-09-01';
        $endDate = date('Y-m-d', strtotime('+11 months', strtotime($startDate)));
        $academicYearName =  $startYear . '-' . ($startYear + 1) . ' Academic Year ';

        return [
            'name' => $academicYearName,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
