<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExpertDetailQualificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_detail_qualification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expert_detail_id')->unsigned();
            $table->foreign('expert_detail_id')->references('id')->on('expert_details');
            $table->integer('qualification_id')->unsigned();
            $table->foreign('qualification_id')->references('id')->on('qualifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expert_detail_qualification');
    }
}
