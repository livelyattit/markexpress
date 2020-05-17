<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFkeyAddFieldsToParcels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropForeign('parcels_addresslog_id_foreign');
            $table->text('binded_addresslog')->after('assigned_parcel_number');
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
            $table->foreign('addresslog_id')->references('id')->on('addresslogs')->constrained()->cascadeOnDelete();
            $table->dropColumn('binded_addresslog');
        });
    }
}
