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
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('phone');
            $table->string('second_phone');
            $table->string('latitude', 255);
            $table->string('longitude', 255);
            $table->text('location')->nullable();
            $table->float('price');
            $table->float('renewal_price')->nullable();
            $table->time('duration');
            $table->boolean('payment_method')->comment('0 => Online', '1 => Cash');
            $table->string('image');
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->boolean('active')->default(1)->comment('0 => Not Active', '1 => Active');
            // $table->string('setting');
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
