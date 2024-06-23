<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LaboratoryTestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $faker = Faker::create('en_US');
        return [
            'name_test' => $faker->name(),
            'description' => $faker->paragraph(),
            'price' => rand(1,200),
            'file_test' => null
        ];
    }
}
