<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAddresslogfieldsParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('binded_addresslog');
            $table->unsignedBigInteger('city_id')->default(466)->after('assigned_parcel_number');
            $table->string('consignee_name')->after('city_id');
            $table->string('consignee_contact')->after('consignee_name');
            $table->string('consignee_address')->after('consignee_contact');
            $table->string('consignee_nearby_address')->nullable()->after('consignee_address');


            // $table->foreign('city_id')->references('id')->on('cities')->constrained()->cascadeOnDelete();
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

            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); //this is also valid
            $table->text('binded_addresslog')->nullable();
            // $table->dropForeign('parcels_city_id_foreign');
            $table->dropColumn('city_id');
            $table->dropColumn('consignee_name');
            $table->dropColumn('consignee_contact');
            $table->dropColumn('consignee_address');
            $table->dropColumn('consignee_nearby_address');
            //Schema::dropIfExists('parcels');
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); //this is also valid
        });

    }
}
