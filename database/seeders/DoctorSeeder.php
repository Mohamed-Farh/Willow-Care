<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $doctor1 = Doctor::create([
            'name' => 'Willow Care',
            'email' => 'willow@willow.com',
            'phone' => '123456789',
            'image' => 'images/doctor/profile/1.jpg',
            'password' => '$2y$10$Qy/k8zANphJ9LHznuYyXmOy9/..HALXRk9tX4Pxhr0EB6wWIym.ta',
            'phone_verification' => 1,
            'professional_title_id' => 1,
            'is_approved' => 1,
            'graduation_year' => 2000,
            'about'       => $faker->paragraph(),
            'country_id'          => 1,
        ]);

        for ($i = 1; $i <5; $i++) {
            $doctor = Doctor::create([
                'name' => $faker->sentence(2, true),
                'email' => $faker->email,
                'phone' => '9665' . random_int(111111111, 999999999),
                'image' => 'images/doctor/profile/'.random_int(2, 10).'.jpg',
                'password' => '$2y$10$Qy/k8zANphJ9LHznuYyXmOy9/..HALXRk9tX4Pxhr0EB6wWIym.ta',
                'phone_verification' => 1,
                'professional_title_id' => random_int(1, 3),
                'is_approved' => 1,
                'graduation_year' => random_int(1980, 2020),
                'gender' => rand(0, 1),
                'about' => $faker->paragraph(),
                'country_id' => $faker->numberBetween(1, 5),
            ]);
        }

        $doctors = Doctor::all();
        foreach($doctors as $doctor){
            for ($i = 1; $i <5; $i++) {
                DB::table('doctor_specialty')->insert([
                    [
                        'doctor_id' => $doctor->id,
                        'specialty_id' => random_int(1, 30),
                    ],
                ]);
            }
        }

    }
}

