<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CashBookController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfitLossController;
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

Route::get('no-access', function () {
    return view('no-access');
})->middleware(['auth', 'verified'])->name('no-access');

Route::get('dashboard', [App\Http\Controllers\DashboardController::class,'index'])
->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('add-order', [App\Http\Controllers\DashboardController::class,'create'])
    ->middleware(['auth', 'verified'])
    ->name('add-order');

Route::post('add-order/create', [App\Http\Controllers\DashboardController::class,'store'])
    ->middleware(['auth', 'verified'])
    ->name('add-order.create');

Route::get('cycles', [App\Http\Controllers\CyclesController::class,'index'])
    ->middleware(['auth', 'verified'])
    ->name('cycles');
Route::get('new/cycle', [App\Http\Controllers\CyclesController::class,'create'])
    ->middleware(['auth', 'verified'])
    ->name('cycle.create');
Route::post('cycles/create', [App\Http\Controllers\CyclesController::class,'store'])
    ->middleware(['auth', 'verified'])
    ->name('cycles.store');
Route::get('cycles/{Cycle_Id}', [App\Http\Controllers\CycleDetailsController::class,'index'])
    ->middleware(['auth', 'verified'])
    ->name('cycles.details.index');

Route::get('cycles/{Cycle_Id}/expenditures/create', [App\Http\Controllers\CyclesWagesController::class, 'index'])->middleware(['auth', 'verified'])->name('cycle.wages.create');
Route::get('cycles/{Cycle_Id}/salaries/create', [App\Http\Controllers\CyclesSalaryController::class, 'index'])->middleware(['auth', 'verified'])->name('cycle.salaries.create');
Route::get('cycles/{Cycle_Id}/advance/create', [App\Http\Controllers\CyclesAdvancesController::class, 'index'])->middleware(['auth', 'verified'])->name('cycle.advance.create');
Route::get('cycles/{Cycle_Id}/transport/create', [App\Http\Controllers\CyclesTransportcontroller::class, 'index'])->middleware(['auth', 'verified'])->name('cycle.transport.create');
Route::get('cycles/{Cycle_Id}/chemicals/create', [App\Http\Controllers\CyclesWagesController::class, 'index'])->middleware(['auth', 'verified'])->name('cycle.chemicals.create');
Route::get('cycles/{Cycle_Id}/seeds/create', [App\Http\Controllers\CyclesSalaryController::class, 'index'])->middleware(['auth', 'verified'])->name('cycle.seeds.create');
Route::get('cycles/{Cycle_Id}/capital-expenses/create', [App\Http\Controllers\CyclesAdvancesController::class, 'index'])->middleware(['auth', 'verified'])->name('cycle.capital-expenses.create');
Route::get('cycles/{Cycle_Id}/maintenance/create', [App\Http\Controllers\CyclesMaintenanceController::class, 'index'])->middleware(['auth', 'verified'])->name('cycle.maintenance.create');
Route::get('cycles/{Cycle_Id}/capital-withdrawal/create', [App\Http\Controllers\CapitalWithdrawalController::class, 'create'])->middleware(['auth', 'verified'])->name('cycle.capital-withdrawal.create');
Route::get('cycles/{Cycle_Id}/capital-expenses/create', [App\Http\Controllers\CapitalExpensesController::class, 'create'])->middleware(['auth', 'verified'])->name('cycle.capital-expenses.create');
Route::get('cycles/{Cycle_Id}/electricity/create', [App\Http\Controllers\ElectrictyController::class, 'create'])->middleware(['auth', 'verified'])->name('cycle.electricity.create');
Route::get('cycles/{Cycle_Id}/sales/create', [App\Http\Controllers\SalesController::class, 'create'])->middleware(['auth', 'verified'])->name('cycle.sales.create');


//Checker Validation Route
Route::get('/checker', [App\Http\Controllers\CheckerController::class,'index'])->middleware(['auth', 'verified'])->name('checker.index');
Route::get('/checker/{Cycle_Id}/validate', [App\Http\Controllers\CheckerController::class,'viewCycleDetails'])->middleware(['auth', 'verified'])->name('checker.details');
Route::post('/checker/{Cycle_Id}/validate', [App\Http\Controllers\CheckerController::class,'approveCycle'])->middleware(['auth', 'verified'])->name('checker.approve');
Route::post('/checker/{Cycle_Id}/{Fin_Id_Id}/validate', [App\Http\Controllers\CheckerController::class,'approveFinancial'])->middleware(['auth', 'verified'])->name('checker.approve');

//Maker
Route::get('/maker', [App\Http\Controllers\MakerController::class,'index'])->middleware(['auth', 'verified'])->name('maker.index');


Route::get('users', [App\Http\Controllers\UsersController::class,'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('users/create', [App\Http\Controllers\UsersController::class, 'create'])->middleware(['auth', 'verified'])->name('users.create');
Route::post('users/create', [App\Http\Controllers\UsersController::class, 'store'])->middleware(['auth', 'verified'])->name('users.store');
Route::get('users/{id}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');
Route::put('users/{id}/edit', [App\Http\Controllers\UsersController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update');
Route::get('users/{id}/delete', [App\Http\Controllers\UsersController::class, 'destroy'])->middleware(['auth', 'verified'])->name('users.delete');

Route::get('users-roles-permissions/{user_id}/create', [App\Http\Controllers\UserRolePermissionsController::class,'index'])->middleware(['auth', 'verified'])->name('users-roles-permissions');
Route::post('users-roles-permissions/{user_id}/create', [App\Http\Controllers\UserRolePermissionsController::class, 'store'])->middleware(['auth', 'verified'])->name('users-roles-permissions.store');
Route::delete('users-roles-permissions/{user}/delete', [App\Http\Controllers\UserRolePermissionsController::class, 'deleteRoles'])->middleware(['auth', 'verified'])->name('users-roles-permissions.delete');

Route::get('roles', [App\Http\Controllers\RolesController::class,'index'])->middleware(['auth', 'verified'])->name('roles');
Route::get('roles/create', [App\Http\Controllers\RolesController::class, 'create'])->middleware(['auth', 'verified'])->name('roles.create');
Route::post('roles/create', [App\Http\Controllers\RolesController::class, 'store'])->middleware(['auth', 'verified'])->name('roles.store');
Route::get('roles/{id}/edit', [App\Http\Controllers\RolesController::class, 'edit'])->middleware(['auth', 'verified'])->name('roles.edit');
Route::put('roles/{id}/edit', [App\Http\Controllers\RolesController::class, 'update'])->middleware(['auth', 'verified'])->name('roles.update');
Route::get('roles/{id}/delete', [App\Http\Controllers\RolesController::class, 'destroy'])->middleware(['auth', 'verified'])->name('roles.delete');

Route::get('roles/{roles_id}/permissions', [App\Http\Controllers\RoleUserController::class, 'index'])->middleware(['auth', 'verified'])->name('roles-permissions');
Route::post('roles/{roles_id}/permissions', [App\Http\Controllers\RoleUserController::class, 'store'])->middleware(['auth', 'verified'])->name('roles-permissions.store');
Route::delete('/roles/{role}/permissions', [App\Http\Controllers\RoleUserController::class, 'deletePermissions'])->middleware(['auth', 'verified'])->name('roles-permissions.delete');


Route::get('permissions', [App\Http\Controllers\PermissionsController::class,'index'])->middleware(['auth', 'verified'])->name('permissions');
Route::get('permissions/create', [App\Http\Controllers\PermissionsController::class, 'create'])->middleware(['auth', 'verified'])->name('permissions.create');
Route::post('permissions/create', [App\Http\Controllers\PermissionsController::class, 'store'])->middleware(['auth', 'verified'])->name('permissions.store');
Route::get('permissions/{id}/edit', [App\Http\Controllers\PermissionsController::class, 'edit'])->middleware(['auth', 'verified'])->name('permissions.edit');
Route::put('permissions/{id}/edit', [App\Http\Controllers\PermissionsController::class, 'update'])->middleware(['auth', 'verified'])->name('permissions.update');
Route::get('permissions/{id}/delete', [App\Http\Controllers\PermissionsController::class, 'destroy'])->middleware(['auth', 'verified'])->name('permissions.delete');

Route::get('password-reset', [App\Http\Controllers\PasswordResetController::class,'index'])->middleware(['auth', 'verified'])->name('password-reset');
Route::get('password-reset/create', [App\Http\Controllers\PasswordResetController::class, 'create'])->middleware(['auth', 'verified'])->name('password-reset.create');

Route::get('departments', [App\Http\Controllers\DepartmentsController::class,'index'])->middleware(['auth', 'verified'])->name('departments');
Route::get('departments/create', [App\Http\Controllers\DepartmentsController::class, 'create'])->middleware(['auth', 'verified'])->name('departments.create');
Route::post('departments/create', [App\Http\Controllers\DepartmentsController::class, 'store'])->middleware(['auth', 'verified'])->name('departments.store');

Route::get('customers', [App\Http\Controllers\CustomerController::class, 'index'])->middleware(['auth', 'verified'])->name('customers');
Route::get('customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->middleware(['auth', 'verified'])->name('customers.create');
Route::post('customers/create', [App\Http\Controllers\CustomerController::class, 'store'])->middleware(['auth', 'verified'])->name('customers.store');
Route::get('customers/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->middleware(['auth', 'verified'])->name('customers.edit');
Route::put('customers/{id}/edit', [App\Http\Controllers\CustomerController::class, 'update'])->middleware(['auth', 'verified'])->name('customers.update');
Route::get('customers/{id}/delete', [App\Http\Controllers\CustomerController::class, 'destroy'])->middleware(['auth', 'verified'])->name('customers.destroy');

Route::get('customers/{Customer_Fname}', [App\Http\Controllers\CustomerSalesController::class, 'index'])->middleware(['auth', 'verified'])->name('customer.sales');


Route::get('suppliers', [App\Http\Controllers\SupplierController::class,'index'])->middleware(['auth', 'verified'])->name('suppliers');
Route::get('suppliers/create', [App\Http\Controllers\SupplierController::class, 'create'])->middleware(['auth', 'verified'])->name('suppliers.create');
Route::post('suppliers/create', [App\Http\Controllers\SupplierController::class, 'store'])->middleware(['auth', 'verified'])->name('suppliers.store');

Route::get('credit', [App\Http\Controllers\CreditController::class,'index'])->middleware(['auth', 'verified'])->name('credit');
Route::get('credit/create', [App\Http\Controllers\CreditController::class, 'create'])->middleware(['auth', 'verified'])->name('credit.create');
Route::post('credit/create', [App\Http\Controllers\CreditController::class, 'store'])->middleware(['auth', 'verified'])->name('credit.store');


Route::get('finances', [App\Http\Controllers\FinanceController::class,'index'])->middleware(['auth', 'verified'])->name('finances');

Route::get('financials/expenditures', [App\Http\Controllers\ExpendituresController::class,'index'])->middleware(['auth', 'verified'])->name('expenditures');
Route::post('financials/expenditures/create', [App\Http\Controllers\ExpendituresController::class, 'store'])->middleware(['auth', 'verified'])->name('expenditures.store');

Route::get('financials/salaries', [App\Http\Controllers\SalaryController::class,'index'])->middleware(['auth', 'verified'])->name('salaries');
Route::post('financials/salaries/create', [App\Http\Controllers\SalaryController::class, 'store'])->middleware(['auth', 'verified'])->name('salaries.store');

Route::get('financials/advance', [App\Http\Controllers\AdvanceController::class,'index'])->middleware(['auth', 'verified'])->name('advance');
Route::post('financials/advance/create', [App\Http\Controllers\AdvanceController::class, 'store'])->middleware(['auth', 'verified'])->name('advance.store');

Route::get('financials/transport', [App\Http\Controllers\Transportcontroller::class,'index'])->middleware(['auth', 'verified'])->name('transport');
Route::post('financials/transport/create', [App\Http\Controllers\Transportcontroller::class, 'store'])->middleware(['auth', 'verified'])->name('transport.store');

Route::get('financials/maintenance', [App\Http\Controllers\MaintenanceController::class,'index'])->middleware(['auth', 'verified'])->name('maintenance');
Route::post('financials/maintenance/create', [App\Http\Controllers\MaintenanceController::class, 'store'])->middleware(['auth', 'verified'])->name('maintenance.store');



Route::get('capital-withdrawal', [App\Http\Controllers\CapitalWithdrawalController::class,'index'])->middleware(['auth', 'verified'])->name('capital-withdrawal');
Route::get('capital-withdrawal/create', [App\Http\Controllers\CapitalWithdrawalController::class, 'create'])->middleware(['auth', 'verified'])->name('capital-withdrawal.create');
Route::post('capital-withdrawal/{Cycle_Id}/create', [App\Http\Controllers\CapitalWithdrawalController::class, 'store'])->middleware(['auth', 'verified'])->name('capital-withdrawal.store');

Route::get('capital-expenses', [App\Http\Controllers\CapitalExpensesController::class,'index'])->middleware(['auth', 'verified'])->name('capital-expenses');
Route::get('capital-expenses/create', [App\Http\Controllers\CapitalExpensesController::class, 'create'])->middleware(['auth', 'verified'])->name('capital-expenses.create');
Route::post('capital-expenses/create', [App\Http\Controllers\CapitalExpensesController::class, 'store'])->middleware(['auth', 'verified'])->name('capital-expenses.store');

Route::get('electricity', [App\Http\Controllers\ElectrictyController::class,'index'])->middleware(['auth', 'verified'])->name('electricity');
Route::get('electricity/create', [App\Http\Controllers\ElectrictyController::class, 'create'])->middleware(['auth', 'verified'])->name('electricity.create');
Route::post('electricity/{Cycle_Id}/create', [App\Http\Controllers\ElectrictyController::class, 'store'])->middleware(['auth', 'verified'])->name('electricity.store');


Route::get('products', [App\Http\Controllers\ProductController::class,'index'])->middleware(['auth', 'verified'])->name('products');
Route::get('products/create', [App\Http\Controllers\ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('products.create');
Route::post('products/create', [App\Http\Controllers\ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('products.store');

Route::get('products-categories', [App\Http\Controllers\CategoryController::class,'index'])->middleware(['auth', 'verified'])->name('products-catgories');
Route::get('products-categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('products-categories.create');
Route::post('products-categories/create', [App\Http\Controllers\CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('products-categories.store');

Route::get('sales', [App\Http\Controllers\SalesController::class,'index'])->middleware(['auth', 'verified', /* 'can:view-sales' */])->name('sales');
Route::post('sales/{Cycle_Id}/create', [App\Http\Controllers\SalesController::class, 'store'])->middleware(['auth', 'verified'])->name('sales.store');

Route::get('cashbook', [App\Http\Controllers\CashBookController::class,'index'])->middleware(['auth', 'verified'])->name('cashbook');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);

Route::get('/cashbook/export-pdf', [CashBookController::class, 'exportPdf']);


/* Route::get('/profit-loss', [App\Http\Controllers\ProfitLossController::class,'index'])->middleware(['auth','verified'])->name('profit-loss'); */
Route::get('/profit-loss', [App\Http\Controllers\ProfitLossController::class, 'index'])->middleware(['auth', 'verified'])->name('profit-loss');
Route::get('/profit-loss/{Cycle_Id}', [App\Http\Controllers\ProfitLossController::class, 'show'])->middleware(['auth', 'verified'])->name('profit-loss.show');
/* Route::post('/profit-loss/compare', [App\Http\Controllers\ProfitLossController::class, 'compare'])->name('profit-loss.compare'); */




require __DIR__.'/auth.php';
