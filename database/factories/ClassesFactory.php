<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departmentIds = \App\Models\Department::pluck('id')->toArray();

        $classNames = [
            'art 1', 'art 2', 'art 3', 'art 4',
            'home 1', 'home 2',
            'tech 1', 'tech 2',
            'visual 1', 'visual 2',
            'science', 'agricultural', 'business',
        ];

        $classLevels = ['1', '2', '3'];

        $usedClassNames = [];

        do {
            $className = $classLevels[array_rand($classLevels)] . ' ' . $classNames[array_rand($classNames)];
        } while (in_array($className, $usedClassNames));

        $usedClassNames[] = $className;

        return [
            'name' => $className,
            'department_id' => $this->faker->randomElement($departmentIds),
        ];
    }
}
