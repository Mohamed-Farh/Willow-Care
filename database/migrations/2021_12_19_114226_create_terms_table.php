<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->longText('text_ar');
            $table->longText('text_en');
            $table->longText('text_ro');
            $table->string('app_type')->comment('Doctor', 'Patient');
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
        Schema::dropIfExists('terms');
    }
}
