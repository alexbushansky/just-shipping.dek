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

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');






Route::group(['prefix'=>'admin','middleware'=>['admin','auth']],function () {

    Route::get('/', 'AdminController@index')->name('admin');
    Route::resource('customers','CustomerController');
    Route::resource('car-types','CarTypeController');

});

//СarTypes getAll
Route::get('get-car-types','CarTypeController@getAllCarType')->name('car-type.getAll');

Route::resource('customer-offers','CustomerOfferController');


//Driver Offers routes
Route::any('driver-offers/send-message','DriverOfferController@sendMessage')->name('driver-offers.sendMessage');
Route::resource('driver-offers','DriverOfferController');
//---------------------------------------------------------
//Dialog routes
Route::resource('dialogs','DialogController');
Route::resource('dialog-messages','DialogMessageController');
//---------------------------------------------------------
//Account Information
//Route::get('account-info','UserController@index')->name('account.info');
//Route::put('account-update','UserController@update')->name('account.update');
Route::post('users/delete-avatar/{user}','UserController@deleteAvatar')->name('users.deleteAvatar')->middleware('auth');
Route::resource('users','UserController')->middleware('auth');

//---------------------------------------------------------
Route::group(['prefix' => 'geonames'],function (){
    Route::get('search', 'GeoNameController@search');
    Route::get('countries', 'GeoNameController@getCountries');
    Route::get('regions/{id}', 'GeoNameController@getRegions');
    Route::get('cities/{id}', 'GeoNameController@getCities');

});


Route::group(['prefix'=>'test'],function (){
    Route::get('test-sinc', 'TestController@testSinc')->middleware('auth');
    Route::post('test-dialog', 'TestController@testDialog')->middleware('auth');
});


Route::get('get-cargo-types','TypesController@getTypes')->name('get.cargo.types');

