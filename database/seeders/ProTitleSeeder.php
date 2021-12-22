<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professional_titles')->insert([
            [
                'name_ar' => 'بكالوريوس',
                'name_en' => 'Bachelor',
                'name_ro' => 'Burlac',
            ],
            [
                'name_ar' => 'الماجستير',
                'name_en' => 'Master',
                'name_ro' => 'Maestre',
            ],
            [
                'name_ar' => 'الدكتوراه',
                'name_en' => 'Doctoral',
                'name_ro' => 'Doctorat',
            ],

        ]);
    }
}
