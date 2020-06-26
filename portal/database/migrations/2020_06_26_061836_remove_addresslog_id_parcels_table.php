<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveAddresslogIdParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('parcels', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); //this is also valid
            //$table->dropForeign(['addresslog_id']);
            $table->dropColumn('addresslog_id');
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); //this is also valid

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
            $table->foreignId('addresslog_id')->default(null)->after('user_id');
        });
    }
}
