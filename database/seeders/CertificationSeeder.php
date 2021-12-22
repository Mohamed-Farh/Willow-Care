<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;
use Faker\Factory;


class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <50; $i++) {
            Certification::create([
                'image' => 'public/images/doctor/certification/'.random_int(1, 5).'.png',
                'doctor_id' => random_int(1, 5),
                'active' => rand(0, 1),
            ]);
        }

    }
}
