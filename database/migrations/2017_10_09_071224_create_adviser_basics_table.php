<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviserBasicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adviser_basics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('landline')->nullable();
            $table->string('language');
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin');
            $table->integer('basic_detail_id')->unsigned()->unique();
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
        Schema::dropIfExists('adviser_basics');
    }
}
