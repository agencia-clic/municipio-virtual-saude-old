<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => 'a',
            'level' => 'a',
            'cpf_cnpj' => rand(10, 99).rand(10, 99).rand(10, 99).rand(10, 99).rand(10, 99)."8",
            'mother' => $this->faker->name(),
            'online' => "s",
            'active_attendance' => 'b',
            'visible' => 'y',
            'rg' => 'MG-1234-0',
            'phone' => $this->faker->phoneNumber(),
            'zip_code' => '000000',
            'address' => $this->faker->address(),
            'number' => $this->faker->address(),
            'email_verified_at' => now(),
            'password' => Hash::make(env('ADMIN_PASS')), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
