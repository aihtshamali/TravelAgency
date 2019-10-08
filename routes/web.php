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
Route::group(['middleware' => 'auth'], function () {
Route::resource('/Customer','CustomerController');
Route::get('leads/AvailableLeads','LeadController@AvailableLeads')->name('AvailableLeads');
Route::post('leads/changeServiceDate','LeadController@changeServiceDate')->name('leads.changeServiceDate');
Route::post('leads/saveNotePad','LeadController@saveNotePad')->name('leads.saveNotePad');
Route::post('leads/saveComment','LeadController@saveComment')->name('leads.saveComment');
Route::get('leads/takeOver','LeadController@takeOver')->name('leads.takeOver');
Route::get('leads/myLeads','LeadController@myLeads')->name('myLeads');
Route::get('leads/searchPhone','LeadController@phoneSearch')->name('leads.searchPhone');
Route::post('leads/searchPhone','LeadController@customerLead')->name('customerLead');
Route::get('/lead/searchByID/','LeadController@searchByID')->name('lead_searchByID');
Route::resource('/leads','LeadController');
// Route::get('/dashboard/home', 'DashboardController@versionone')->name('home');
// Route::get('/dashboard/v2', 'DashboardController@versiontwo')->name('v2');
// Route::get('/dashboard/v3', 'DashboardController@versionthree')->name('v3');
Route::resource('/Customer','CustomerController');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/Customer/addsale/{customer}', 'CustomerController@addSale')->name('addSale');
Route::post('/Customer/savesale', 'CustomerController@saveSale')->name('saveSale');
Route::get('/Customer/addrefund/{customer}', 'CustomerController@addRefund')->name('addRefund');
Route::post('/Customer/saverefund', 'CustomerController@saveRefund')->name('saveRefund');
Route::get('/Customer/addpayment/{customer}', 'CustomerController@addPayment')->name('addPayment');
Route::post('/Customer/savepayment', 'CustomerController@savePayment')->name('savePayment');
});



