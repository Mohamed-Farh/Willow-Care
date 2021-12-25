<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->boolean('phone_verification')->default(0)->comment('0 => Not Verified','1 => Verified');
            $table->boolean('is_approved')->default(0)->comment('0 => Not Approved','1 => Approved');
            $table->string('f_code')->nullable();
            $table->string('g_code')->nullable();
            $table->string('a_code')->nullable();
            $table->foreignId('professional_title_id')->nullable();
            $table->year('graduation_year')->nullable();
            $table->boolean('gender')->default(0)->comment('0 => Male', '1 => Female');
            $table->longText('about')->nullable();
            $table->string('lang')->default('en')->comment('ro => Romanian','en => English', 'ar => Arabic');
            $table->boolean('activation')->default(1)->comment('0 => Not Active', '1 => Active');
            $table->tinyInteger('country_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
