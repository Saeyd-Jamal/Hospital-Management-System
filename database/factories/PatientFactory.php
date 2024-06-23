<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'patient_id' => rand(400000000,500000000),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'gender' => $this->faker->randomElement(['ذكر', 'أنثى']),
            'image' => $this->faker->imageUrl(250,250),
        ];
    }
}
