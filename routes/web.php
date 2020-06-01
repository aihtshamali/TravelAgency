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
Route::post('leads/TransferLead','LeadController@transferLead')->name('transferLead');
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

Route::post('/Customer/saveEditedPayment', 'CustomerController@saveEditedPayment')->name('saveEditedPayment');

Route::get('/changeSaleStatus/{id}/{status}', 'CustomerController@changeSaleStatus')->name('changeSaleStatus');
Route::get('/changePaymentStatus/{id}/{status}', 'CustomerController@changePaymentStatus')->name('changePaymentStatus');
Route::get('/approveSale/{id}', 'CustomerController@approveSale')->name('approveSale');
Route::get('/approveRefund/{id}', 'CustomerController@approveRefund')->name('approveRefund');
Route::get('/approvePayment/{id}', 'CustomerController@approvePayment')->name('approvePayment');
Route::post('/Customer/uploadattachments', 'CustomerController@uploadattachments')->name('uploadattachments');

Route::get('/userperformance', 'CustomerController@userperformance')->name('userperformance');

Route::post('/userPerformanceReportIndividual', 'CustomerController@userPerformanceReportIndividual')->name('userPerformanceReportIndividual');

Route::post('/userPerformanceReportDouble', 'CustomerController@userPerformanceReportDouble')->name('userPerformanceReportDouble');

Route::get('/viewSaleByID/{id?}','SaleController@viewSaleByID')->name('viewSaleByID');
Route::get('/viewDocumentByID/{id?}','SaleController@viewDocumentByID')->name('viewDocumentByID');
Route::get('/viewPaymentByID/{id?}','PaymentController@viewPaymentByID')->name('viewPaymentByID');
Route::get('/editSale/{id?}','SaleController@editSale')->name('editSale');
Route::get('/editRefund/{id?}','SaleController@editRefund')->name('editRefund');
Route::get('/editPayment/{id?}','PaymentController@editPayment')->name('editPayment');
Route::get('userLeadsbyId/{id?}','LeadController@userLeadsbyId')->name('userLeadsbyId');
Route::get('/leadStatusreport' ,'LeadController@leadStatusreport')->name('leadStatusreport');

Route::post('/leadStatusReportsearch' ,'LeadController@leadStatusReportsearch')->name('leadStatusReportsearch');
Route::post('/statusReportDouble' ,'LeadController@statusReportDouble')->name('statusReportDouble');

Route::get('/takeLeads' ,'LeadController@takeLeads')->name('takeLeads');
Route::get('/getClosedLeads' ,'LeadController@getClosedLeads')->name('getClosedLeads');
Route::get('/getOpenLeads' ,'LeadController@getOpenLeads')->name('getOpenLeads');
Route::get('/getCompletedLeads' ,'LeadController@getCompletedLeads')->name('getCompletedLeads');
Route::get('/getWorkingLeads' ,'LeadController@getWorkingLeads')->name('getWorkingLeads');
// 
//Individual Reports
Route::get('/myTransactions','IndividualReportController@transactions')->name('mytransactions');
Route::get('/FinalizedLeads','IndividualReportController@FinalizedLeads')->name('FinalizedLeads');
Route::get('/saleReport/{user?}','IndividualReportController@saleReport')->name('saleReport');
Route::post('/saleReport','IndividualReportController@saleReportSearch')->name('saleReportSearch');
//package

Route::get('/createpackageview','PackageController@index')->name('createpackageview');

Route::post('/createPackage','PackageController@create')->name('createPackage');

Route::get('/viewPackage','PackageController@view')->name('viewPackage');
Route::post('/deletePackage/{id}','PackageController@deletePackage')->name('deletePackage');

//User Dashboard
Route::resource('/User','UserController');
Route::get('/searchUserView','UserController@searchUserView')->name('searchUserView');
Route::post('/searchUser','UserController@searchUser')->name('searchUser');
Route::get('/activeUser','UserController@activeUser')->name('activeUser');
Route::get('/blockUser','UserController@blockUser')->name('blockUser');
Route::get('/rolesAuthorityView','UserController@rolesAuthorityView')->name('rolesAuthorityView');
Route::get('/userActivitylogView','UserController@userActivitylogView')->name('userActivitylogView');
Route::get('/userDetails/{id}','UserController@userDetails')->name('userDetails');
Route::get('/rolesPermissionView','UserController@rolesPermissionView')->name('rolesPermissionView');
Route::post('/removePerm/{id}','UserController@removePerm')->name('removePerm');
Route::post('/addPermission','UserController@addPermission')->name('addPermission');
Route::get('/PermissionAssignView','UserController@PermissionAssignView')->name('PermissionAssignView');
Route::post('/assignPermission','UserController@assignPermission')->name('assignPermission');
Route::post('/removePermRole','UserController@removePermRole')->name('removePermRole');
Route::get('/Details/{id}','UserController@Details')->name('Details');
Route::post('/assignRole','UserController@assignRole')->name('assignRole');
Route::post('/removerole','UserController@removerole')->name('removerole');
Route::post('/updateDetails','UserController@updateDetails')->name('updateDetails');
Route::get('/assignedUsertoRoles/{id}','UserController@assignedUsertoRoles')->name('assignedUsertoRoles');
Route::get('/showDetailByUserName/{usernamw}','UserController@showDetailByUserName')->name('showDetailByUserName');

Route::get('/showDetailByUserNameCRM/{usernamw}','UserController@showDetailByUserNameCRM')->name('showDetailByUserNameCRM');

// Cashbook
Route::get('/CashbookHome','CashbookController@index')->name('cashbookIndex');
Route::get('/summarydetails','CashbookController@summary')->name('summarydetails');
Route::get('/searchcashbook','CashbookController@search')->name('search');
Route::post('/cashIn','CashbookController@cashIn')->name('cashIn');
Route::post('/cashOut','CashbookController@cashOut')->name('cashOut');
Route::post('/close_cashbook','CashbookController@close_cashbook')->name('close_cashbook');
Route::get('/bank','CashbookController@bank')->name('bank');
Route::post('/addbank','CashbookController@addbank')->name('addbank');
Route::post('/delete_bank/{id}','CashbookController@delete_bank')->name('delete_bank');

Route::get('/bankreport','CashbookController@bankreport')->name('bankreport');

Route::post('/bankBasedreport','CashbookController@bankBasedreport')->name('bankBasedreport');

Route::get('/viewPendingPayments','PaymentController@viewPendingPayments')->name('viewPendingPayments');
Route::get('/AllLeads','LeadController@allLeads')->name('AllLeads');
Route::get('/leadReport','LeadController@leadReport')->name('leadReport');
Route::post('/leadReport','LeadController@leadReportSearch')->name('leadReportSearch');
});



