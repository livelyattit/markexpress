<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAccountdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->cascadeOnDelete();
            $table->string('business_name');
            $table->integer('shipment_quantity')->unsigned();
            $table->string('bank_name');
            $table->string('bank_account_title');
            $table->string('bank_account_number');
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
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0'); //this is also valid
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('accountdetails');
        Schema::enableForeignKeyConstraints();
    }
}
