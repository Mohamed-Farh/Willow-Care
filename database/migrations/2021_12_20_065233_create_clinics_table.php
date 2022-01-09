<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->string('name');
            // $table->string('phone');
            // $table->string('another_phone')->nullable();
            // $table->string('lat', 255);
            // $table->string('long', 255);
            // $table->text('location')->nullable();
            // $table->float('price');
            // $table->float('renewal_price')->nullable();
            // $table->time('duration');
            // $table->tinyInteger('payment_method')->comment('1 => Online', '2 => Cash','3=>both');
            // $table->string('image');
            // $table->foreignId('doctor_id');
            // $table->boolean('active')->default(1)->comment('0 => Not Active', '1 => Active');
            // $table->string('setting')->nullable();
            // $table->timestamps();

            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('another_phone')->nullable();
            $table->string('lat', 255)->nullable();
            $table->string('long', 255)->nullable();
            $table->text('location')->nullable();
            $table->float('price')->nullable();
            $table->float('renewal_price')->nullable();
            $table->time('duration')->nullable();
            $table->tinyInteger('payment_method')->comment('1 => Online', '2 => Cash','3=>both')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('doctor_id');
            $table->boolean('active')->default(1)->comment('0 => Not Active', '1 => Active');
            $table->string('setting')->nullable();
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
        Schema::dropIfExists('clinics');
    }
}
