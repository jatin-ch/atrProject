<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consultation_booking_id')->unsigned();
            $table->string('experties');
            $table->string('consultation_mode');
            $table->string('consultaing_fee');
            $table->string('adviceli_commision');
              $table->integer('consultation_invoice_id')->unsigned();
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
        Schema::dropIfExists('consultation_invoice_details');
    }
}
