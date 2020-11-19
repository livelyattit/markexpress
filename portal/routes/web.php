<?php

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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::get('/test', 'TestController@index')->name('test');
Route::get('file/{authid}/{location}/{filename}', 'HelperController@getContentFile')->where([
    'filename' => '^[^/]+$'
])->name('content');

Route::get('/test/user-info', "TestController@getUserRole");


// Customer Routes

Route::middleware(['customer'])->group(function () {

    Route::prefix('customer')->group(function () {

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

Route::prefix('admin')->group(function () {

    Route::get('login', 'AdminLoginController@showLoginForm')->name('admin-users');
    Route::post('login/owner', 'AdminLoginController@login')->name('admin-owner-login');
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', 'AdminController@index')->name('admin-dashboard');

        // users routes
        Route::post('file-upload-bill', 'CustomerController@fileUploadBill')->name('file-upload-bill');
        Route::post('file-upload-cnic', 'CustomerController@fileUploadCnic')->name('file-upload-cnic');
        Route::match(['get', 'post'], 'user/{action}/{id?}/{form_name?}', 'AdminController@user')->name('admin-user');

        //parcel route
        Route::match(['get', 'post'], 'parcel/{action}/{id?}/{form_name?}', 'AdminController@parcel')->name('admin-parcel');

        Route::match(['get', 'post'], 'csv/upload', 'AdminController@csv')->name('admin-csv');
        Route::get('ajax/customers', 'AdminController@ajaxUsersList')->name('admin-customers-list');
    });
});


//Route::get('/home', 'HomeController@index');


Route::group(['prefix' => 'developer'], function () {
    Voyager::routes();
});
