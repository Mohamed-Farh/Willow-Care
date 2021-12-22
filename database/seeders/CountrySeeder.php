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
                'code' => '002',
                'flag' => 'public/images/category/Egypt.jpg',
            ],
            [
                'name_ar' => 'السعودية',
                'name_en' => 'Saudi Arabia',
                'name_ro' => 'Arabia Saudită',
                'code' => '003',
                'flag' => 'public/images/category/Saudi.jpg',
            ],
            [
                'name_ar' => 'الكويت',
                'name_en' => 'Kuwait',
                'name_ro' => 'Kuweit',
                'code' => '004',
                'flag' => 'public/images/category/Kuwait.jpg',
            ],
            [
                'name_ar' => 'البحرين',
                'name_en' => 'Bahrain',
                'name_ro' => 'Bahrain',
                'code' => '005',
                'flag' => 'public/images/category/Bahrain.jpg',
            ],
            [
                'name_ar' => 'عمان',
                'name_en' => 'Oman',
                'name_ro' => 'Oman',
                'code' => '006',
                'flag' => 'public/images/category/Oman.jpg',
            ],

        ]);
    }
}
