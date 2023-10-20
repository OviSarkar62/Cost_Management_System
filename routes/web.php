<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// User Registration Routes
Route::get('/register/user', [AuthController::class, 'createUser'])->name('create.user');
Route::post('/register/user', [AuthController::class, 'storeUser'])->name('store.user');
// User Login Routes
Route::view('/login', 'user.user-login')->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//-----------------------------User Dashboard------------------------------------------------
// Dashboard User
Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
//----------------------------------Income-----------------------------------------------------
// Create income
Route::get('/income/create', [IncomeController::class, 'createIncome'])->name('create.income');
// List income
Route::get('/income/list', [IncomeController::class, 'incomeList'])->name('list.income');
// Store income
Route::post('/income/store', [IncomeController::class, 'storeIncome'])->name('store.income');
// Edit income
Route::get('/income/edit/{id}', [IncomeController::class, 'editIncome'])->name('edit.income');
// Update income
Route::put('/income/{id}', [IncomeController::class, 'updateIncome'])->name('update.income');
// Delete income
Route::delete('/income/{id}', [IncomeController::class, 'destroyIncome'])->name('destroy.income');

//----------------------------------Expense-----------------------------------------------------
// Create income
Route::get('/expense/create', [ExpenseController::class, 'createExpense'])->name('create.expense');
// List income
Route::get('/expense/list', [ExpenseController::class, 'expenseList'])->name('list.expense');
// Store income
Route::post('/expense/store', [ExpenseController::class, 'storeExpense'])->name('store.expense');
// Edit income
Route::get('/expense/edit/{id}', [ExpenseController::class, 'editExpense'])->name('edit.expense');
// Update income
Route::put('/expense/{id}', [ExpenseController::class, 'updateExpense'])->name('update.expense');
// Delete income
Route::delete('/expense/{id}', [ExpenseController::class, 'destroyExpense'])->name('destroy.expense');
