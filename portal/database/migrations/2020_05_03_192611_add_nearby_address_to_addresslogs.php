<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNearbyAddressToAddresslogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresslogs', function (Blueprint $table) {
            $table->string('consignee_nearby_address')->nullable()->after('consignee_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresslogs', function (Blueprint $table) {
            //
        });
    }
}
