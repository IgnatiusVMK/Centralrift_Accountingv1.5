<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    $accountController = new AccountController();
    return $accountController->summary();
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('role', [App\Http\Controllers\UsersController::class,'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('role/create', [App\Http\Controllers\UsersController::class, 'create'])->middleware(['auth', 'verified'])->name('users');
Route::post('role/create', [App\Http\Controllers\UsersController::class, 'store'])->middleware(['auth', 'verified'])->name('users');
Route::get('role/{id}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->middleware(['auth', 'verified'])->name('users');
Route::put('role/{id}/edit', [App\Http\Controllers\UsersController::class, 'update'])->middleware(['auth', 'verified'])->name('users');
Route::get('role/{id}/delete', [App\Http\Controllers\UsersController::class, 'destroy'])->middleware(['auth', 'verified'])->name('users');


Route::get('departments', [App\Http\Controllers\DepartmentsController::class,'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('departments/create', [App\Http\Controllers\DepartmentsController::class, 'create'])->middleware(['auth', 'verified'])->name('users');
Route::post('departments/create', [App\Http\Controllers\DepartmentsController::class, 'store'])->middleware(['auth', 'verified'])->name('users');


Route::get('customers', [App\Http\Controllers\CustomerController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->middleware(['auth', 'verified'])->name('users');
Route::post('customers/create', [App\Http\Controllers\CustomerController::class, 'store'])->middleware(['auth', 'verified'])->name('users');
Route::get('customers/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->middleware(['auth', 'verified'])->name('users');
Route::put('customers/{id}/edit', [App\Http\Controllers\CustomerController::class, 'update'])->middleware(['auth', 'verified'])->name('users');
Route::get('customers/{id}/delete', [App\Http\Controllers\CustomerController::class, 'destroy'])->middleware(['auth', 'verified'])->name('users');

Route::get('credit/credit', [App\Http\Controllers\CreditController::class,'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('credit/credit/create', [App\Http\Controllers\CreditController::class, 'create'])->middleware(['auth', 'verified'])->name('users');
Route::post('credit/credit/create', [App\Http\Controllers\CreditController::class, 'store'])->middleware(['auth', 'verified'])->name('users');


Route::get('financials/expenditures', [App\Http\Controllers\ExpendituresController::class,'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('financials/expenditures/create', [App\Http\Controllers\ExpendituresController::class, 'create'])->middleware(['auth', 'verified'])->name('users');
Route::post('financials/expenditures/create', [App\Http\Controllers\ExpendituresController::class, 'store'])->middleware(['auth', 'verified'])->name('users');

Route::get('financials/salaries', [App\Http\Controllers\SalaryController::class,'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('financials/salaries/create', [App\Http\Controllers\SalaryController::class, 'create'])->middleware(['auth', 'verified'])->name('users');
Route::post('financials/salaries/create', [App\Http\Controllers\SalaryController::class, 'store'])->middleware(['auth', 'verified'])->name('users');

Route::get('financials/advance', [App\Http\Controllers\AdvanceController::class,'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('financials/advance/create', [App\Http\Controllers\AdvanceController::class, 'create'])->middleware(['auth', 'verified'])->name('users');
Route::post('financials/advance/create', [App\Http\Controllers\AdvanceController::class, 'store'])->middleware(['auth', 'verified'])->name('users');


Route::get('products', [App\Http\Controllers\ProductController::class,'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('products/create', [App\Http\Controllers\ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('users');
Route::post('products/create', [App\Http\Controllers\ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('users');

Route::get('cashbook', [App\Http\Controllers\CashBookController::class,'index'])->middleware(['auth', 'verified'])->name('users');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
