<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'last_name_kana' => fake()->lastKanaName(),
            'first_name_kana' => fake()->firstKanaName(),
            'role_id' => '1234',
            'prefecture' => fake()->prefecture(),
            'address1' => fake()->streetAddress(),
            'address2' => fake()->secondaryAddress(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => '2014-04-01 11:22:33',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(5),
            'join_date' => '2014-04-01 11:22:33',
            'created_at' => '2023-03-08 11:22:33',
            'updated_at' => '2023-03-08 11:22:33',
            'deleted_at' => null,


        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
