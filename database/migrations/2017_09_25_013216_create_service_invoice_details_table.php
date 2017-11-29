<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_booking_id')->unsigned();
            $table->string('service_name');
            $table->string('service_mode');
            $table->string('service_fee');
            $table->string('adviceli_commision');
            $table->integer('service_invoice_id')->unsigned();
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
        Schema::dropIfExists('service_invoice_details');
    }
}
