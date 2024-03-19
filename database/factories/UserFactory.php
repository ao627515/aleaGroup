<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        return [
            'name' => strtolower(fake()->name()),
            'phone' => fake()->unique()->randomNumber(8),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['user', 'admin']),
            'remember_token' => Str::random(10),
        ];
    }
}
