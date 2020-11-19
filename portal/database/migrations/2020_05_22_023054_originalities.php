<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Originalities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('originalities', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('originality_verified')->unsigned();
            $table->string('status');

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
        Schema::drop('originalities', function (Blueprint $table) {
            $table->dropColumn('originality_verified');
            $table->dropColumn('status');
        });
    }
}
