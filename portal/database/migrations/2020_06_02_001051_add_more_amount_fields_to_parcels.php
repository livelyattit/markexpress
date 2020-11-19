<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreAmountFieldsToParcels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->decimal('t_basic_charges',19,2, true)->nullable()->after('amount');
            $table->decimal('t_booking_charges',19,2, true)->nullable()->after('t_basic_charges');
            $table->decimal('t_cash_handling_charges',19,2, true)->nullable()->after('t_booking_charges');
            $table->decimal('t_packing_charges',19,2, true)->nullable()->after('t_cash_handling_charges');
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
            $table->dropColumn('t_basic_charges');
            $table->dropColumn('t_booking_charges');
            $table->dropColumn('t_cash_handling_charges');
            $table->dropColumn('t_packing_charges');
        });
    }
}
