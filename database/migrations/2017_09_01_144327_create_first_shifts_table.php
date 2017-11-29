<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day');
            $table->time('time_from');
            $table->time('time_to');
            $table->integer('location_id')->nullable();
            $table->integer('availability_id')->unsigned();
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
        Schema::dropIfExists('first_shifts');
    }
}
