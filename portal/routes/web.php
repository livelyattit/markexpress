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
    'filename'=> '^[^/]+$'
    ])->name('content');



// Customer Routes

Route::middleware(['customer'])->group(function (){

    Route::get('/customer/dashboard', 'CustomerController@index')->name('customer-dashboard');
    Route::get('/customer/create-parcel', 'CustomerController@createParcel')->name('customer-create-parcel');
    Route::get('/customer/edit-profile', 'CustomerController@editProfile')->name('customer-edit-profile');

//    addresslog
    Route::resources([
        'address-log' => 'AddresslogController',
        'parcel' => 'ParcelController'
    ]);

// Post Routes
Route::post('/customer/file-upload-bill', 'CustomerController@fileUploadBill')->name('file-upload-bill');
Route::post('/customer/file-upload-cnic', 'CustomerController@fileUploadCnic')->name('file-upload-cnic');
Route::post('/customer/proceed-verification', 'CustomerController@proceedVerification')->name('customer-verification-proceed');
Route::post('/parcel/get-consignee', 'ParcelController@getConsignee')->name('parcel-get-consignee');

});

Route::prefix('admin')->group(function(){

    Route::get('login', 'AdminLoginController@showLoginForm')->name('admin-users');
    Route::post('login/owner', 'AdminLoginController@login')->name('admin-owner-login');
    Route::middleware(['admin'])->group(function (){
        Route::get('dashboard', 'AdminController@index')->name('admin-dashboard');
        Route::get('users', 'AdminController@users')->name('admin-users');
        Route::match(['get', 'post'],'user/create', 'AdminController@createUser')->name('admin-create-user');
        Route::match('user/edit/{id}', 'AdminController@editUser')->name('admin-edit-user');
        Route::match('user/delete/{id}', 'AdminController@deleteUser')->name('admin-delete-user');
    });

});


//Route::get('/home', 'HomeController@index');


Route::group(['prefix' => 'developer'], function () {
    Voyager::routes();
});
