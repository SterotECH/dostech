<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        $firstName = fake()->firstName($gender);
        $lastName = fake()->lastName();
        $otherNames = fake()->optional()->firstName($gender);

        $houseIds = \App\Models\House::pluck('id')->toArray();
        $departmentIds = \App\Models\Department::pluck('id')->toArray();
        $classesIds = \App\Models\Classes::pluck('id')->toArray();

        return [
            'house_id' => fake()->randomElement($houseIds),
            'department_id' => fake()->randomElement($departmentIds),
            'classes_id' => fake()->randomElement($classesIds),
            'registration_number' => fake()->unique()->randomNumber(5),
            'date_of_birth' => fake()->date(),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'other_names' => $otherNames,
            'gender' => $gender,
            'dues_owed' => fake()->randomFloat(2, 0, 500),
            'is_active' => fake()->boolean(),
            'has_completed' => fake()->boolean(),
            'valid_until' => fake()->optional()
                ->dateTimeBetween('-1 year', '+4 year'),
        ];
    }
}
