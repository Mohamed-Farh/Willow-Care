<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('insurance_companies')->insert([
            [
                'name_ar' => 'شركة التأمين رقم 1',
                'name_en' => 'Insurance Company EN 1',
                'name_ro' => 'Insurance Company OR 1',
                'image' => 'images/insuranceCompany/company.png',

            ],
            [
                'name_ar' => 'شركة التأمين رقم 2',
                'name_en' => 'Insurance Company EN 2',
                'name_ro' => 'Insurance Company OR 2',
                'image' => 'images/insuranceCompany/company.png',

            ],
            [
                'name_ar' => 'شركة التأمين رقم 3',
                'name_en' => 'Insurance Company EN 3',
                'name_ro' => 'Insurance Company OR 3',
                'image' => 'images/insuranceCompany/company.png',

            ],
            [
                'name_ar' => 'شركة التأمين رقم 4',
                'name_en' => 'Insurance Company EN 4',
                'name_ro' => 'Insurance Company OR 4',
                'image' => 'images/insuranceCompany/company.png',

            ],
            [
                'name_ar' => 'شركة التأمين رقم 5',
                'name_en' => 'Insurance Company EN 5',
                'name_ro' => 'Insurance Company OR 5',
                'image' => 'images/insuranceCompany/company.png',

            ],
            [
                'name_ar' => 'شركة التأمين رقم 6',
                'name_en' => 'Insurance Company EN 6',
                'name_ro' => 'Insurance Company OR 6',
                'image' => 'images/insuranceCompany/company.png',

            ],

        ]);
    }
}
