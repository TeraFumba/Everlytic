<?php

namespace Database\Seeders;

use App\Models\Employees;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 6) as $index) {
            Employees::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'position' => $faker->jobTitle(),
                'email' => $faker->email,
            ]);
        }

    }
}
