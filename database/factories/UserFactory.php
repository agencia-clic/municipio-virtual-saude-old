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
            'name' => $this->faker->name,
            'social_name'=> $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf_cnpj' => $this->faker->unique()->numerify('###########'),
            'mother' => $this->faker->firstNameFemale,
            'status' => $this->faker->randomElement(['a']),
            'online' => 'f',
            'active_attendance' => $this->faker->randomElement(['a']),
            'visible' => 'y',
            'level' => $this->faker->randomElement(['s']),
            'image' => $this->faker->imageUrl(),
            'rg' => $this->faker->numerify('##########'),
            'phone' => $this->faker->numerify('34########'),
            'zip_code' => $this->faker->numerify('########'),
            'address' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'complement' => $this->faker->secondaryAddress,
            'date_birth' => $this->faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'district' => $this->faker->citySuffix,
            'city' => $this->faker->city,
            'uf_rg' => $this->faker->stateAbbr,
            'crm' => $this->faker->numerify('##########'),
            'crn' => $this->faker->numerify('##########'),
            'uf_crm' => $this->faker->stateAbbr,
            'uf' => $this->faker->stateAbbr,
            'origin' => $this->faker->country,
            'uf_naturalness' => $this->faker->stateAbbr,
            'naturalness' => $this->faker->city,
            'cell' => $this->faker->numerify('34#########'),
            'voter_registration' => $this->faker->numerify('##########'),
            'cns' => $this->faker->numerify('##########'),
            'chart' => $this->faker->numerify('##########'),
            'breed' => $this->faker->randomElement(['B', 'N', 'P', 'A', 'I', 'O']),
            'sex' => $this->faker->randomElement(['f', 'm', 'o']),
            'sanguine' => $this->faker->randomElement(['A+', 'A-', 'B+', 'AB+', 'AB-', 'O-', 'O+', 'n']),
            'marital_status' => $this->faker->randomElement(['c', 's', 'v']),
            'schooling' => $this->faker->randomElement(['ca', 'c', 'ef', 'efc', 't', 'si', 's']),
            'occupation' => $this->faker->jobTitle,
            'rules' => $this->faker->paragraph,
            'password' => Hash::make(env('ADMIN_PASS')), // password
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
