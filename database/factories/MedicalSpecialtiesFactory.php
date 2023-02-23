<?php

namespace Database\Factories;

use App\Models\MedicalSpecialties;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalSpecialtiesFactory extends Factory
{
    protected $model = MedicalSpecialties::class;

    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['a', 'b']),
            'code' => $this->faker->unique()->numberBetween(100, 999),
            'title' => $this->faker->word(),
            'service' => $this->faker->randomElement(['y', 'n']),
        ];
    }
}