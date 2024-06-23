<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Doctor;
use App\Models\LaboratoryTest;
use App\Models\MedicinesStore;
use App\Models\Patient;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // Section::factory(10)->create();
        // Doctor::factory(20)->create();
        // Patient::factory(1000)->create();
        // MedicinesStore::factory(1000)->create();
        // LaboratoryTest::factory(250)->create();

        // User::create([
        //     'name' => 'السيد الاخرس',
        //     'username' => 'saeyd_jamal',
        //     'password' => Hash::make('20051118Jamal'),
        //     'email' => 'alsaeydjalkhras@gmail.com',
        //     'phone_number' => "+972594318545",
        // ]);
    }
}
