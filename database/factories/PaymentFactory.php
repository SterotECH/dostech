<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $studentIds = \App\Models\Student::pluck('id')->toArray();
        $semesterIds = \App\Models\Semester::pluck('id')->toArray();
        $houseMasterIds = \App\Models\HouseMaster::pluck('id')->toArray();
        $classesIds = \App\Models\Classes::pluck('id')->toArray();

        return [
            'student_id' => fake()->randomElement($studentIds),
            'semester_id' => fake()->randomElement($semesterIds),
            'house_master_id' => fake()->randomElement($houseMasterIds),
            'classes_id' => fake()->randomElement($classesIds),
            'amount_paid' => fake()->randomFloat(2, 10, 500),
            'remaining_balance' => fake()->randomFloat(2, 0, 100),
            'payment_date' => fake()->dateTimeThisMonth(),
            'payment_method' => fake()->randomElement(['cash', 'mobile_money', 'bank_transfer', 'cheque']),
            'reference_number' => fake()->unique()->uuid(10),
        ];
    }
}
