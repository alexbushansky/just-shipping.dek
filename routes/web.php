<?php

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

Route::get('/',function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');






Route::group(['prefix'=>'admin','middleware'=>['admin','auth']],function () {

    Route::get('/', 'AdminController@index')->name('admin');
    Route::resource('customers','CustomerController');
    Route::resource('car-types','CarTypeController');

});

Route::resource('customer-offers','CustomerOfferController');
Route::any('driver-offers/send-message','DriverOfferController@sendMessage')->name('driver-offers.sendMessage');
Route::resource('driver-offers','DriverOfferController');



Route::group(['prefix' => 'geonames'],function (){
    Route::get('search', 'GeoNameController@search');
    Route::get('countries', 'GeoNameController@getCountries');
    Route::get('regions/{id}', 'GeoNameController@getRegions');
    Route::get('cities/{id}', 'GeoNameController@getCities');
});
