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

/* Route::get('/dashboard', function () {
    $accountController = new AccountController();
    return $accountController->summary();
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');

Route::get('/add-order', [App\Http\Controllers\DashboardController::class,'create'])->name('add-order');
Route::post('/add-order/create', [App\Http\Controllers\DashboardController::class,'store'])->name('add-order.create');


Route::get('role', [App\Http\Controllers\UsersController::class,'index'])->middleware(['auth', 'verified'])->name('role');
Route::get('role/create', [App\Http\Controllers\UsersController::class, 'create'])->middleware(['auth', 'verified'])->name('role.create');
Route::post('role/create', [App\Http\Controllers\UsersController::class, 'store'])->middleware(['auth', 'verified'])->name('role.store');
Route::get('role/{id}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->middleware(['auth', 'verified'])->name('role.edit');
Route::put('role/{id}/edit', [App\Http\Controllers\UsersController::class, 'update'])->middleware(['auth', 'verified'])->name('role.update');
Route::get('role/{id}/delete', [App\Http\Controllers\UsersController::class, 'destroy'])->middleware(['auth', 'verified'])->name('role.delete');


Route::get('departments', [App\Http\Controllers\DepartmentsController::class,'index'])->middleware(['auth', 'verified'])->name('departments');
Route::get('departments/create', [App\Http\Controllers\DepartmentsController::class, 'create'])->middleware(['auth', 'verified'])->name('departments.create');
Route::post('departments/create', [App\Http\Controllers\DepartmentsController::class, 'store'])->middleware(['auth', 'verified'])->name('departments.store');


Route::get('customers', [App\Http\Controllers\CustomerController::class, 'index'])->middleware(['auth', 'verified'])->name('customers');
Route::get('customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->middleware(['auth', 'verified'])->name('customers.create');
Route::post('customers/create', [App\Http\Controllers\CustomerController::class, 'store'])->middleware(['auth', 'verified'])->name('customers.store');
Route::get('customers/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->middleware(['auth', 'verified'])->name('customers.edit');
Route::put('customers/{id}/edit', [App\Http\Controllers\CustomerController::class, 'update'])->middleware(['auth', 'verified'])->name('ucustomers.update');
Route::get('customers/{id}/delete', [App\Http\Controllers\CustomerController::class, 'destroy'])->middleware(['auth', 'verified'])->name('customers.destroy');

Route::get('suppliers', [App\Http\Controllers\SupplierController::class,'index'])->middleware(['auth', 'verified'])->name('suppliers');
Route::get('suppliers/create', [App\Http\Controllers\SupplierController::class, 'create'])->middleware(['auth', 'verified'])->name('suppliers.create');
Route::post('suppliers/create', [App\Http\Controllers\SupplierController::class, 'store'])->middleware(['auth', 'verified'])->name('suppliers.store');

Route::get('credit', [App\Http\Controllers\CreditController::class,'index'])->middleware(['auth', 'verified'])->name('credit');
Route::get('credit/create', [App\Http\Controllers\CreditController::class, 'create'])->middleware(['auth', 'verified'])->name('credit.create');
Route::post('credit/create', [App\Http\Controllers\CreditController::class, 'store'])->middleware(['auth', 'verified'])->name('credit.store');


Route::get('financials/expenditures', [App\Http\Controllers\ExpendituresController::class,'index'])->middleware(['auth', 'verified'])->name('expenditures');
Route::get('financials/expenditures/create', [App\Http\Controllers\ExpendituresController::class, 'create'])->middleware(['auth', 'verified'])->name('expenditures.create');
Route::post('financials/expenditures/create', [App\Http\Controllers\ExpendituresController::class, 'store'])->middleware(['auth', 'verified'])->name('expenditures.store');

Route::get('financials/salaries', [App\Http\Controllers\SalaryController::class,'index'])->middleware(['auth', 'verified'])->name('salaries');
Route::get('financials/salaries/create', [App\Http\Controllers\SalaryController::class, 'create'])->middleware(['auth', 'verified'])->name('salaries.create');
Route::post('financials/salaries/create', [App\Http\Controllers\SalaryController::class, 'store'])->middleware(['auth', 'verified'])->name('salaries.store');

Route::get('financials/advance', [App\Http\Controllers\AdvanceController::class,'index'])->middleware(['auth', 'verified'])->name('advance');
Route::get('financials/advance/create', [App\Http\Controllers\AdvanceController::class, 'create'])->middleware(['auth', 'verified'])->name('advance.create');
Route::post('financials/advance/create', [App\Http\Controllers\AdvanceController::class, 'store'])->middleware(['auth', 'verified'])->name('advance.store');


Route::get('products', [App\Http\Controllers\ProductController::class,'index'])->middleware(['auth', 'verified'])->name('products');
Route::get('products/create', [App\Http\Controllers\ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('products.create');
Route::post('products/create', [App\Http\Controllers\ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('products.store');

Route::get('/products-categories', [App\Http\Controllers\CategoryController::class,'index'])->middleware(['auth', 'verified'])->name('products-catgories');
Route::get('/products-categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('products-categories.create');
Route::post('/products-categories/create', [App\Http\Controllers\CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('products-categories.store');

Route::get('cashbook', [App\Http\Controllers\CashBookController::class,'index'])->middleware(['auth', 'verified'])->name('cashbook');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
