<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\CapitalHistoryController;

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

Route::get('/', function () {
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//company
Route::get('/get/company/list',  [CompanyController::class, 'getCompanyList']);
Route::post('/get/company/record', [CompanyController::class, 'getCompanyRecord']);
Route::post('/update/company/data', [CompanyController::class, 'updateCompany']);
Route::post('/company/add/data', [CompanyController::class, 'addCompany']);
Route::get('/company/add', [CompanyController::class, 'addCompanyForm']);
Route::get('/company', [CompanyController::class, 'index']);

//user
Route::middleware(['auth'])->group(function () {
    Route::get('/get/user/list/{id}', [UserController::class, 'getUserList']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/add', [UserController::class, 'addUserForm']);
    Route::post('/user/add/data', [UserController::class, 'addUser']);
    Route::get('/user/edit/{id}', [UserController::class, 'editUserForm']);
    Route::post('/edit/user', [UserController::class, 'editUser']);
    Route::get('/get/uses', [UserController::class, 'getUsersSession']);
    Route::get('/get/user/{id}', [UserController::class, 'getUserRecord']);
    Route::get('/get/loanee/{id}', [UserController::class, 'getLoaneeRecord']);
    Route::get('/new/user/login', [UserController::class, 'newUserForm']);
    Route::post('/add/loanee', [UserController::class, 'addLoanee']);
    Route::get('/get/employees', [UserController::class, 'getEmployees']);
    Route::get('/gedit/employees', [UserController::class, 'getEmployeesforEdit']);
});
Route::get('/logintemp', [UserController::class, 'logintemp']);
Route::get('/registertemp', [UserController::class, 'registertemp']);

//role
Route::get('/get/role/list', [RolesController::class, 'getRoleList']);

//config
Route::get('/config/edit', [ConfigurationController::class, 'editConfigForm']);
Route::get('/get/config', [ConfigurationController::class, 'getConfigurationList']);
Route::post('/config/edit', [ConfigurationController::class, 'updateConfiguration']);

//loan
Route::get('/loan/request', [LoansController::class, 'requestLoan']);
Route::post('/loan/add/data', [LoansController::class, 'addLoan']);
Route::get('/users/loan/{id}', [LoansController::class, 'getPendingLoanRecord']);
Route::get('/get/loan/employees/{id}', [LoansController::class, 'getLoanEmployees']);
Route::get('/loan/employees', [LoansController::class, 'showLoanEmployees']);
Route::get('/approve/loan/{id}', [LoansController::class, 'approveLoan']);
Route::get('/acknowledge/loan/{id}', [LoansController::class, 'acknowledgeLoan']);
Route::get('/loan/detail/{id}', [LoansController::class, 'showLoanDetails']);
Route::get('/get/loan/detail/{id}', [LoansController::class, 'getLoanDetails']);
Route::get('/pay/loan/{id}', [LoansController::class, 'showLoanPayForm']);
Route::post('/pay/loan', [LoansController::class, 'payLoan']);
Route::get('/get/historys/loan/{id}', [LoansController::class, 'getHistorysLoan']);
Route::get('/loan/add', [LoansController::class, 'addLoanForm']);
Route::post('/create/loan', [LoansController::class, 'createLoan']);
Route::post('/loan/update', [LoansController::class, 'loanUpdate']);
Route::get('/loan/edit/{id}', [LoansController::class, 'loanEditForm']);
Route::get('/default/loan/{id}', [LoansController::class, 'loanDefault']);
//company loans
Route::get('/loan/companies', [LoansController::class, 'companyLoans']);
Route::get('/get/loan/companies', [LoansController::class, 'getCompanyLoans']);
Route::get('/loancompany/detail/{id}', [LoansController::class, 'companyLoanDetail']);


//capital
Route::get('/capital/list',  [CapitalHistoryController::class, 'showCapitalHistoryList']);
Route::get('/get/capital/list',  [CapitalHistoryController::class, 'getCapitalHistoryList']);
Route::get('/capital/add',  [CapitalHistoryController::class, 'showAddCapitalForm']);
Route::post('/add/capital', [CapitalHistoryController::class, 'addCapital']);
Route::get('/get/current/capital', [CapitalHistoryController::class, 'getCurrentCapital']);