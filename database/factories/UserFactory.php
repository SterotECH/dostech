<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

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

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'other_name' => $otherNames,
            'username' => fake()->unique()->userName,
            'phone' => fake()->unique()->phoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'role' => fake()->randomElement(['admin', 'house_master', 'user']),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin()
    {
        return $this->state(fn (array $attributes) => ['role' => 'admin']);
    }

    public function houseMaster()
    {
        return $this->state(fn (array $attributes) => ['role' => 'house_master']);
    }

    public function user()
    {
        return $this->state(fn (array $attributes) => ['role' => 'user']);
    }
}
