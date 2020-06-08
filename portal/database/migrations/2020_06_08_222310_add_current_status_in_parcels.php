<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentStatusInParcels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->string('current_last_status')->nullable()->after('binded_addresslog');
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
           $table->dropColumn('current_last_status');
        });
    }
}
