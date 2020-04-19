<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmationFieldsUserPersonalData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_personal_data', function (Blueprint $table) {

            $table->boolean('bill_request_confirmation')->nullable()->after('cnic_file_name');
            $table->boolean('cnic_request_confirmation')->nullable()->after('bill_request_confirmation');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_personal_data', function (Blueprint $table) {
        
            $table->dropColumn('bill_request_confirmation');
            $table->dropColumn('cnic_request_confirmation');
        });
    }
}
