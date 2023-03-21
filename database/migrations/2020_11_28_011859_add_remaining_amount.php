<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemainingAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {

            $table->decimal('total_delivery_amount',19,2, true)->nullable()->after('t_packing_charges');
            $table->decimal('remaining_amount',19,2, true)->nullable()->after('total_delivery_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {

            $table->dropColumn('total_delivery_amount');
            $table->dropColumn('remaining_amount');
        });
    }
}
