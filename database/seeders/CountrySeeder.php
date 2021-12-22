<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            [
                'name_ar' => 'مصر',
                'name_en' => 'Egypt',
                'name_ro' => 'Egipt',
            ],
            [
                'name_ar' => 'السعودية',
                'name_en' => 'Saudi Arabia',
                'name_ro' => 'Arabia Saudită',
            ],
            [
                'name_ar' => 'الكويت',
                'name_en' => 'Kuwait',
                'name_ro' => 'Kuweit',
            ],
            [
                'name_ar' => 'البحرين',
                'name_en' => 'Bahrain',
                'name_ro' => 'Bahrain',
            ],
            [
                'name_ar' => 'عمان',
                'name_en' => 'Oman',
                'name_ro' => 'Oman',
            ],

        ]);
    }
}
