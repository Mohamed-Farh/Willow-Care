<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name_ar', 255);
			$table->string('name_en', 255);
			$table->string('name_ro', 255);
			$table->string('image', 255)->nullable();
            $table->boolean('active')->default(1)->comment('0 => Not Active', '1 => Active');
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
        Schema::dropIfExists('insurance_companies');
    }
}
