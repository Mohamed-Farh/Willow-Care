<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysOfWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('week_days')->insert([
            [
                'name_ar' => 'الأحد',
                'name_en' => 'Sunday',
                'name_ro' => 'Duminică',

            ],
            [
                'name_ar' => 'الأثنين',
                'name_en' => 'Monday',
                'name_ro' => 'Luni',

            ],
            [
                'name_ar' => 'الثلاثاء',
                'name_en' => 'Tuesday',
                'name_ro' => 'Marți',

            ],
            [
                'name_ar' => 'الأربعاء',
                'name_en' => 'Wednesday',
                'name_ro' => 'Miercuri',

            ],
            [
                'name_ar' => 'الخميس',
                'name_en' => 'Thursday',
                'name_ro' => 'Joi',

            ],
            [
                'name_ar' => 'الجمعة',
                'name_en' => 'Friday',
                'name_ro' => 'Vineri',

            ],
            [
                'name_ar' => 'السبت',
                'name_en' => 'Saturday',
                'name_ro' => 'Sâmbătă',

            ],
        ]);
    }
}
