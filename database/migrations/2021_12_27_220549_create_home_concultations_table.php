<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeConcultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_concultations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('doctor_id');
            $table->float('price');
            $table->float('renewal_price')->nullable();
            $table->tinyInteger('payment_method')->comment('1 => Online', '2 => Cash');
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
        Schema::dropIfExists('home_concultations');
    }
}
