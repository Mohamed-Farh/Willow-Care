<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
			$table->string('name_ar', 255);
			$table->string('name_en', 255);
			$table->string('name_ro', 255);
            $table->string('flag')->nullable();
            $table->tinyInteger('code');
            $table->boolean('active')->default(1)->comment('0 => Not Active', '1 => Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
