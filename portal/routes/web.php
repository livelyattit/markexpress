<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::domain(env('ADMIN_URL'))->group(base_path('routes/admin.php'));

Route::domain(env('SITE_URL'))->group(function() {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::get('/test', 'TestController@index')->name('test');
    Route::get('/test/user-info', "TestController@getUserRole");

    //Route::group(base_path('routes/customer.php'));
    Route::prefix('customer')->group(function () {


        Route::middleware(['customer'])->group(function () {

            Route::get('file/{authid}/{location}/{filename}', 'HelperController@getContentFile')->where([
                'filename' => '^[^/]+$'
            ])->name('content-customer');

            Route::get('dashboard', 'CustomerController@index')->name('customer-dashboard');
            Route::get('edit-profile', 'CustomerController@editProfile')->name('customer-edit-profile');

            Route::get('parcels-chart', 'CustomerController@parcelsChart')->name('customer-parcel-chart');

            Route::match(['get', 'post'], '/parcel/all-parcels', 'ParcelController@allParcels')->name('customer-all-parcels');
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

});


Auth::routes();



Route::group(['prefix' => 'developer'], function () {
    Voyager::routes();
});




