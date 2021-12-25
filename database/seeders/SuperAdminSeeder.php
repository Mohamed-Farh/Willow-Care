<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
             'name'=>'super_admin',
             'email' => 'admin@admin.com',
             'phone'=>'0123456789',
             'password' =>  Hash::make('password123'),
             'created_at' => Carbon::now(),
        ]);
    }
}
