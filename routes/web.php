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





Route::post('orders/toCompleteOrder/{id}','CustomerOfferController@toCompleteOrder')->name('completeOrder');
Route::get('orders/showCompletedOrders/','CustomerOfferController@showCompletedOrders')->name('completedOrders');
Route::get('dialogs/all','DialogController@showAllUsersDialogs')->name('showDialogs');
Route::get('orders/show-one-completed-order/{id}','CustomerOfferController@getOneCompletedOrder')->name('oneCompletedOrder');
Route::get('dialogs/all-offers-dialog','DialogController@showAllOffersForYou')->name('showOfferDialogs');
Route::resource('customer-offers','CustomerOfferController');


Route::resource('driver-car','DriverCarController');




//Driver Offers routes
Route::any('driver-offers/send-message','DriverOfferController@sendMessage')->name('driver-offers.sendMessage');
Route::resource('driver-offers','DriverOfferController');
//---------------------------------------------------------
//Dialog routes

Route::group(['prefix'=>'user-panel','middleware'=>['auth']],function () {
    Route::resource('dialogs','DialogController');
    Route::resource('dialog-messages','DialogMessageController');
    Route::post('offers/acceptOffer/{id}','CustomerOfferController@acceptOffer')->name('acceptCustomerOffer');
    Route::get('offers/activeOrders/','CustomerOfferController@activeOrders')->name('showActiveOrders')->middleware('check.list.active.orders');
    Route::get('offers/showActiveOrder/{id}','CustomerOfferController@showActiveOrder')->name('showActiveOrder')->middleware('check.active.order');
});




//---------------------------------------------------------
//Account Information
//Route::get('account-info','UserController@index')->name('account.info');
//Route::put('account-update','UserController@update')->name('account.update');
Route::post('users/delete-avatar/{user}','UserController@deleteAvatar')->name('users.deleteAvatar')->middleware('auth');
Route::get('user/guest-page/{user}','UserController@getGuestRoom')->name('guest-room');
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


Route::get('getTest','TestController@TestModel')->name('testModel');


Route::get('getEvent','TestController@testEvent')->name('testEvent');

Route::post('post-mark','MarkController@putMark')->name('postMark');
