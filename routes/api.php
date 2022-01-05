<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminApiController;
use App\Http\Controllers\AdminApiRegController;
use App\Http\Controllers\AdminApiAllListController;
use App\Http\Controllers\AdminApiLoanController;
use App\Http\Controllers\AdminApiNewsController;
use App\Http\Controllers\HomeAPIController;
use App\Http\Controllers\AccountAPIController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Home API

Route::get('/loan-types', [HomeAPIController::class, 'welcome']);
Route::get('/all-news', [HomeAPIController::class, 'news']);
Route::post('/apilogin', [HomeAPIController::class, 'loginSubmit']);

//-------------------------------------Account---------------------------------------------------------//
//Account Registration
Route::post('/apiregister', [AccountAPIController::class, 'register']);
//Account dashboard
Route::get('/account-dashboard/{id}', [AccountAPIController::class, 'dashboard'])->middleware("AccountAPIAuth");
//Account Logout
Route::get('/apilogout/{key}', [AccountAPIController::class, 'logout'])->middleware("AccountAPIAuth");
//Account Transections
Route::get('/account-history/{id}', [AccountAPIController::class, 'history'])->middleware("AccountAPIAuth");
//Account Profile
Route::get('/account-profile/{id}', [AccountAPIController::class, 'profile'])->middleware("AccountAPIAuth");
//Account Profile Edit
Route::post('/account-profile/edit', [AccountAPIController::class, 'editSubmit'])->middleware("AccountAPIAuth");
//Account Password Change
Route::post('/account-profile/change-password', [AccountAPIController::class, 'changepasswordSubmit'])->middleware("AccountAPIAuth");
//Account Beneficiary
Route::post('/account-add-beneficiary', [AccountAPIController::class, 'addbeneficiarySubmit'])->middleware("AccountAPIAuth");
//Account Beneficiary List
Route::get('/account-beneficiary-list/{id}', [AccountAPIController::class, 'beneficiarylist'])->middleware("AccountAPIAuth");
//Account Send Money to Beneficiary
Route::post('/account-send-money', [AccountAPIController::class, 'sendSubmit'])->middleware("AccountAPIAuth");
//Account External Payment
Route::post('/account-payment', [AccountAPIController::class, 'paymentSubmit'])->middleware("AccountAPIAuth");
//Account Beneficiary Delete
Route::get('/account-beneficiary-delete/{id}', [AccountAPIController::class, 'deletebeneficiary'])->middleware("AccountAPIAuth");
//Account Loan Request
Route::post('/account-loan-request', [AccountAPIController::class, 'loanrequestSubmit'])->middleware("AccountAPIAuth");
//Account Loan Status Check
Route::get('/account-loan-status/{id}', [AccountAPIController::class, 'loanstatus'])->middleware("AccountAPIAuth");
//Account Loan Request Delete
Route::get('/account-loan-request-delete/{id}', [AccountAPIController::class, 'deleterequest'])->middleware("AccountAPIAuth");
//Account E-statement
Route::get('/account-statement/{from}/{to}/{id}', [AccountAPIController::class, 'downloadEStatement'])->middleware("AccountAPIAuth");

//-------------------------------------Admin-----------------------------------------------------------//

Route::get('/admin/info/{id}',[AdminApiController::class , 'adminInfromation'])->middleware('AdminApiAuth');
Route::get('/bank/info/{id}',[AdminApiController::class , 'bankInfromation'])->middleware('AdminApiAuth');

Route::get('/admin/dashboard',[AdminApiController::class , 'adminDashboard'])->middleware('AdminApiAuth');
Route::get('/admin/profileinfo/{id}',[AdminApiController::class , 'adminProfile'])->middleware('AdminApiAuth');
Route::get('/admin/history',[AdminApiController::class , 'history'])->middleware('AdminApiAuth');

//Admin Profile Update
Route::post('/admin/editprofile/{b_id}/{ad_id}',[AdminApiController::class , 'adminUpdate'])->middleware('AdminApiAuth');

//Admin Update Picture
Route::post('/admin/updatePicture/{id}',[AdminApiController::class , 'updatePicture'])->middleware('AdminApiAuth');




//admin Create New Admin
Route::post('/admin/create/admin/users',[AdminApiRegController::class , 'createAdmin'])->middleware('AdminApiAuth');

//admin Create New Employee
Route::post('/admin/create/employee/users',[AdminApiRegController::class , 'createEmp'])->middleware('AdminApiAuth');

//admin Create New Customer
Route::get('/admin/create/account/users',[AdminApiRegController::class , 'customerRegistration'])->middleware('AdminApiAuth');
Route::post('/admin/create/account/users',[AdminApiRegController::class , 'createCustomer'])->middleware('AdminApiAuth');

//admin Users Lists
Route::get('/admin/dashboard/adminList',[AdminApiAllListController::class , 'adminList'])->middleware('AdminApiAuth');
Route::get('/admin/dashboard/employeeList',[AdminApiAllListController::class , 'empList'])->middleware('AdminApiAuth');
Route::get('/admin/dashboard/customerList',[AdminApiAllListController::class , 'cusList'])->middleware('AdminApiAuth');

Route::get('/admin/dashboard/allUserList',[AdminApiAllListController::class , 'userList'])->middleware('AdminApiAuth');

//Admin List Edit
Route::get('/admin/adminlist/edit/{id}',[AdminApiAllListController::class , 'adminListEdit'])->middleware('AdminApiAuth');
Route::post('/admin/adminlist/update/{id}',[AdminApiAllListController::class , 'adminListUpdate'])->middleware('AdminApiAuth');


//Admin List Delete
Route::get('admin/adminlist/delete-admin/{id}',[AdminApiAllListController::class , 'deleteList'])->middleware('AdminApiAuth');

//Admin Employee List Update
Route::get('/admin/emplist/edit/{id}',[AdminApiAllListController::class , 'empListEdit']);
Route::post('/admin/emplist/update/{id}',[AdminApiAllListController::class , 'empListUpdate'])->middleware('AdminApiAuth');


//Admin Employee List Delete
Route::get('admin/employees/delete-employee/{id}',[AdminApiAllListController::class , 'deleteEmpList'])->middleware('AdminApiAuth');



//Admin Customer List Update
Route::get('/admin/customerlist/edit/{id}',[AdminApiAllListController::class , 'cusListEdit'])->middleware('AdminApiAuth');
Route::post('/admin/customerlist/update/{id}',[AdminApiAllListController::class , 'cusListUpdate'])->middleware('AdminApiAuth');


//Admin Customer List Delete
Route::get('admin/customerlist/disable/{id}',[AdminApiAllListController::class , 'disableCusList'])->middleware('AdminApiAuth');

//Admin Customers Request
Route::get('/admin/customer/requests',[AdminApiAllListController::class , 'customerRequests'])->middleware('AdminApiAuth');

//Admin Customers Request Accept/Disable
Route::get('/admin/customer/requests/accept/{id}',[AdminApiAllListController::class , 'customerRequestsAccept'])->middleware('AdminApiAuth');
Route::get('/admin/customer/requests/disable/{id}',[AdminApiAllListController::class , 'customerRequestsDisable'])->middleware('AdminApiAuth');


//Admin Loans Request
Route::get('/admin/loan/requests',[AdminApiLoanController::class , 'loanRequests'])->middleware('AdminApiAuth');

//Admin Loans Request Accept/Disable
Route::get('/admin/loan/requests/accept/{id}',[AdminApiLoanController::class , 'loanRequestsAccept'])->middleware('AdminApiAuth');
Route::get('/admin/loan/requests/reject/{id}',[AdminApiLoanController::class , 'loanRequestsReject'])->middleware('AdminApiAuth');


//Admin News
Route::post('/admin/news/create',[AdminApiNewsController::class , 'newsUpdate'])->middleware('AdminApiAuth');


//Admin Account All List

Route::get('/admin/account/alllist',[AdminApiController::class , 'accountAllList'])->middleware('AdminApiAuth');
