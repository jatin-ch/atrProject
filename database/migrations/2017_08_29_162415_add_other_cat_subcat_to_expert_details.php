<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherCatSubcatToExpertDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expert_details', function (Blueprint $table) {
            $table->string('other_cat')->after('major_subcat');
            $table->string('other_subcat')->after('other_cat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expert_details', function (Blueprint $table) {
            $table->dropColumn('other_cat');
            $table->dropColumn('other_subcat');
        });
    }
}
