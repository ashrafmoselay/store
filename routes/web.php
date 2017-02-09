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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::group(['middleware' => 'auth'], function () {
	Route::get('products/search/{term?}','ProductsController@search');
	Route::get('products/qtyDetailes/{id}','ProductsController@qtyDetailes');
	Route::get('products/salesDetailes/{id}','ProductsController@salesDetailes');
	Route::resource('/products','ProductsController');
	Route::get('products/destroy/{id}','ProductsController@destroy');
	Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'PurchaseInvoiceController@autocomplete'));
	Route::resource('/purchaseInvoice','PurchaseInvoiceController');
	Route::get('orders/search','OrdersController@search');
	//Route::get('orders', ['as' => 'orders.index', 'uses' => 'OrdersController@index']);
	Route::resource('/orders','OrdersController');
	Route::get('purchaseInvoice/destroy/{id}','PurchaseInvoiceController@destroy');

	Route::get('clients/search/{term?}','ClientsController@search');
	Route::resource('/clients','ClientsController');
	Route::get('clients/destroy/{id}','ClientsController@destroy');
	Route::get('clients/pay/{id}','ClientsController@pay');
	
	Route::post('addpay',['as'=>'addpay','uses'=>'ClientsController@addpay']);
	Route::resource('/suppliers','SuppliersController');
	Route::get('suppliers/destroy/{id}','SuppliersController@destroy');
});
