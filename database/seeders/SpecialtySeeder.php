<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <20; $i++) {
            Specialty::create([
                'name_ar' => $faker->sentence(2, true),
                'name_en' => $faker->sentence(2, true),
                'name_ro' => $faker->sentence(2, true),
                'icon' => 'images/doctor/specialty/'.random_int(1, 5).'.png',
                'active' => rand(0, 1),
            ]);
        }


        for ($i = 1; $i <20; $i++) {
            Specialty::create([
                'name_ar' => $faker->sentence(2, true),
                'name_en' => $faker->sentence(2, true),
                'name_ro' => $faker->sentence(2, true),
                'icon' => 'images/doctor/specialty/'.random_int(1, 5).'.png',
                'active' => rand(0, 1),
            ]);
        }

        $specialties = Specialty::all();
        foreach($specialties as $specialty){
            for ($i = 1; $i < $specialties->count(); $i++) {
                DB::table('category_specialties')->insert([
                    [
                        'category_id' => random_int(1, 6),
                        'specialty_id' => $specialty->id,
                    ],
                ]);
            }
        }

    }
}
