<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('experience')->unsigned();
            $table->string('major_cat');
            $table->string('major_subcat');
            $table->string('qualification')->nullable();
            $table->string('also_for')->nullable();
            $table->string('about');
            $table->integer('user_id')->unsigned()->unique();
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
        Schema::dropIfExists('expert_details');
    }
}
