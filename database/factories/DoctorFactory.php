<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sections = Section::pluck('id')->toArray();
        return [
            'name' => $this->faker->name(),
            'doctor_id' => rand(400000000,500000000),
            'username' => $this->faker->username(),
            'password' => Hash::make('password'),
            'phone_number' => $this->faker->phoneNumber(),
            'section_id' => $this->faker->randomElement($sections),
            'image' => $this->faker->imageUrl(250,250),
            'specialty' => $this->faker->text(10),
        ];
    }
}
