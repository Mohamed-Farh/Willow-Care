<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_titles', function (Blueprint $table) {
            $table->id()->autoIncrement();
			$table->string('name_ar', 255);
			$table->string('name_en', 255);
			$table->string('name_ro', 255);
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
        Schema::dropIfExists('professional_titles');
    }
}
