<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;
use Faker\Factory;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <10; $i++) {
            Term::create([
                'text_ar' => $faker->paragraph(),
                'text_en' => $faker->paragraph(),
                'text_ro' => $faker->paragraph(),
                'type' => rand(0, 1),
                'app_type' => 'Doctor',
                'active' => rand(0, 1),
            ]);
        }

        for ($i = 1; $i <10; $i++) {
            Term::create([
                'text_ar' => $faker->paragraph(),
                'text_en' => $faker->paragraph(),
                'text_ro' => $faker->paragraph(),
                'type' => rand(0, 1),
                'app_type' => 'Patient',
                'active' => rand(0, 1),
            ]);
        }
    }
}
