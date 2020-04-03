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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'ContactController@index')->name('contact');
Auth::routes();


// Customer Routes
Route::get('/customer/dashboard', 'CustomerController@index')->name('customer-dashboard');
Route::get('/customer/create-parcel', 'CustomerController@createParcel')->name('customer-create-parcel');
Route::get('/customer/edit-profile', 'CustomerController@editProfile')->name('customer-edit-profile');

//Route::get('/home', 'HomeController@index');
