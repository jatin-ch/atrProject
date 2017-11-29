<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('un_availabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->date('from_date');
            $table->time('from_time');
            $table->date('to_date');
            $table->time('to_time');
            $table->string('service');
            $table->boolean('off_all');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('un_availabilities');
    }
}
