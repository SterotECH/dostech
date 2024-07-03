<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseMaster>
 */
class HouseMasterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        $houseId = \App\Models\House::inRandomOrder()->first()->id;

        $firstName = $this->faker->firstName($gender);
        $lastName = $this->faker->lastName($gender);

        $user = \App\Models\User::factory()->houseMaster()->create([
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        return [
            'house_id' => $houseId,
            'user_id' => $user->id,
            'gender' => $gender,
        ];
    }
}
