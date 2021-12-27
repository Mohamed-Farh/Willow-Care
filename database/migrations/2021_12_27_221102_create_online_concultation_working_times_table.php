<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineConcultationWorkingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_concultation_working_times', function (Blueprint $table) {
            $table->id();
            $table->bigIncrements('id');
            $table->string('day');
            $table->time('from');
			$table->time('to');
            $table->foreignId('online_concultation_id');
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
        Schema::dropIfExists('online_concultation_working_times');
    }
}
