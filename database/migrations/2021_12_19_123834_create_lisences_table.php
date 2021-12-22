<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLisencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lisences', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('image');
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('lisences');
    }
}
