<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name_ar' => 'الدكتور',
                'name_en' => 'Doctor',
                'name_ro' => 'Doctor',
                'image' => 'public/images/category/doctor.jpg',

            ],
            [
                'name_ar' => 'المريض',
                'name_en' => 'Patient',
                'name_ro' => 'Pacient',
                'image' => 'public/images/category/patient.jpg',

            ],
            [
                'name_ar' => 'الممرضة',
                'name_en' => 'Nurse',
                'name_ro' => 'Asistenta',
                'image' => 'public/images/category/nurse.jfif',

            ],
            [
                'name_ar' => 'المستشفي',
                'name_en' => 'Hospital',
                'name_ro' => 'Spital',
                'image' => 'public/images/category/hospital.png',

            ],
            [
                'name_ar' => 'العيادة',
                'name_en' => 'Clinic',
                'name_ro' => 'Clinica',
                'image' => 'public/images/category/clinic.jfif',

            ],
            [
                'name_ar' => 'الصيدلية',
                'name_en' => 'Pharmacy',
                'name_ro' => 'Farmacie',
                'image' => 'public/images/category/pharmacy.png',

            ],

        ]);
    }
}
