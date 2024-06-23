<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MedicinesStoreFactory extends Factory
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
            'name' => $faker->name(),
            'description' => $faker->paragraph(),
            'producing_company' => $faker->company(),
            'end_date' => $faker->date('Y-m-d'),
            'medicine_image' => $faker->imageUrl(250,250),
            'quantity' => rand(1,1000),
            'price_sale' => rand(1,200),
            'basic_price' => rand(1,200),
            'profit' => rand(1,100)
        ];
    }
}
