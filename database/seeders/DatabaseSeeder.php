<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            // CountrySeeder::class,
            ProTitleSeeder::class,
            DaysOfWeekSeeder::class,
            SpecialtySeeder::class,
            DoctorSeeder::class,
            TermSeeder::class,
            CertificationSeeder::class,
        ]);
    }
}
