<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightPriceToCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
           $table->string('initial_weight_limit')->after('is_enabled');
           $table->string('initial_weight_price')->after('initial_weight_limit');
           $table->string('additional_weight_price')->after('initial_weight_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('initial_weight_limit');
            $table->dropColumn('initial_weight_price');
            $table->dropColumn('additional_weight_price');
        });
    }
}
