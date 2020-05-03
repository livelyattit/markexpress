<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ParcelStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('parcel_id')->references('id')->on('parcels')->constrained()->cascadeOnDelete();
            $table->foreignId('status_id')->references('id')->on('statuses')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('parcel_status');
    }
}
