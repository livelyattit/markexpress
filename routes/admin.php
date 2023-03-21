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


    //if user is not logged in, it will show login form
    //else it will go to dashboard..
    Route::get('/', function () {
        return redirect(route('login'));
    });


    Route::get('/test', function(){

        echo file_exists(storage_path('app/public/users_bills/42201-1254400-7-1679383091-Screenshot 2023-03-21 at 7.49.46 AM.png'));

       echo storage_path('app/public/users_bills');

    });




    Route::get('login', 'AdminLoginController@showLoginForm')->name('login');

    Route::post('login/owner', 'AdminLoginController@login')->name('admin-owner-login');


    /* we cannot call adminlogincontroller because it redirects to dashboard.. thats why we
        are directly calling the view here */
        //this url is for safe side, incase of any error, admin can logout from here
        Route::get('logout', 'AdminController@showLogoutForm')->name('admin-logout');


    Route::middleware(['admin'])->group(function () {


        Route::get('file/{authid}/{location}/{filename}', 'HelperController@getContentFile')->where([
            'filename' => '^[^/]+$'
        ])->name('content-admin');

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

