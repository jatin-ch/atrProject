<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConsultationUnAvailability extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_un_availability', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consultation_id')->unsigned();
            $table->foreign('consultation_id')->references('id')->on('consultations');
            $table->integer('un_availability_id')->unsigned();
            $table->foreign('un_availability_id')->references('id')->on('un_availabilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultation_un_availability');
    }
}
