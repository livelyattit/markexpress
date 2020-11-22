<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::prefix('customer')->group(function () {



    Route::middleware(['customer'])->group(function () {



        Route::get('dashboard', 'CustomerController@index')->name('customer-dashboard');
        Route::get('edit-profile', 'CustomerController@editProfile')->name('customer-edit-profile');

        //    addresslog
        Route::resources([
            'address-log' => 'AddresslogController',
            'parcel' => 'ParcelController'
        ]);


        // Post Routes
        Route::post('file-upload-bill', 'CustomerController@fileUploadBill')->name('file-upload-bill');
        Route::post('file-upload-cnic', 'CustomerController@fileUploadCnic')->name('file-upload-cnic');
        Route::post('proceed-verification', 'CustomerController@proceedVerification')->name('customer-verification-proceed');
        Route::post('proceed-business-information', 'CustomerController@proceedBusinessInformation')->name('customer-business-information-proceed');
    });

    Route::post('/parcel/get-consignee', 'ParcelController@getConsignee')->name('parcel-get-consignee');
});
