<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            // 'role' => $this->faker->randomElement(['user', 'admin']), // Generate random role
            'role' => $this->faker->randomElement(['user']), // Generate random role
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(), // Generate unique username
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(), // Generate unique phone number
            'password' => Hash::make('password'), // Default password
            'avatar' => $this->faker->imageUrl(200, 200, 'people', true, 'Avatar'), // Generate avatar image URL
            'rank' => $this->faker->randomElement(['beginner', 'intermediate', 'expert']), // Random rank
            'xp' => $this->faker->numberBetween(0, 1000), // Random XP
            'email_verified_at' => $this->faker->optional()->dateTime(), // Random verified date or null
            'remember_token' => Str::random(10),
        ];
    }
}
