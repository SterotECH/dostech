<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departmentNames = [
            'science', 'general arts', 'languages', 'mathematics',
            'technical', 'visual', 'home science'
        ];

        return [
            'name' => Str::ucfirst(fake()->unique()->randomElement($departmentNames)),
        ];
    }
}
