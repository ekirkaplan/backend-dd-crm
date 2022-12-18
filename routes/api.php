<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SquadController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ArrivalLocationController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\CustomerUnitPriceController;
use App\Http\Controllers\ExitWarehouseController;
use App\Http\Controllers\RegionDirectorController;
use App\Http\Controllers\ChiefDirectorController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TaxOfficeController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ContractController;


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

Route::prefix('auth')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::post('refresh', 'refresh');
        Route::post('logout', 'logout');
        Route::post('login', 'login');
    });
});

Route::middleware(['jwt.verify'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('/auth/me', [LoginController::class, 'me']);
    Route::get('medias/get-media-by-id/{id}', [MediaController::class, 'getMediaById']);

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('users', UserController::class);


    Route::controller(RoleController::class)->prefix('roles')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('roles', RoleController::class);

    Route::controller(SquadController::class)->prefix('squads')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('squads', SquadController::class);

    Route::controller(CompanyController::class)->prefix('companies')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('companies', CompanyController::class);

    Route::controller(EmployeeController::class)->prefix('employees')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
        Route::get('out-of-squad-employee', 'outOfSquadEmployee');
        Route::get('out-of-squad-foreman', 'outOfSquadForeman');
    });
    Route::apiResource('employees', EmployeeController::class);

    Route::controller(CustomerController::class)->prefix('customers')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('customers', CustomerController::class);

    Route::controller(SupplierController::class)->prefix('suppliers')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('suppliers', SupplierController::class);

    Route::controller(ArrivalLocationController::class)->prefix('arrival-locations')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('arrival-locations', ArrivalLocationController::class);

    Route::controller(ProductTypeController::class)->prefix('product-types')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('product-types', ProductTypeController::class);

    Route::controller(CustomerUnitPriceController::class)->prefix('customer-unit-prices')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('customer-unit-prices', CustomerUnitPriceController::class);

    Route::controller(ExitWarehouseController::class)->prefix('exit-warehouses')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('exit-warehouses', ExitWarehouseController::class);

    Route::controller(RegionDirectorController::class)->prefix('region-directors')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('region-directors', RegionDirectorController::class);

    Route::controller(ChiefDirectorController::class)->prefix('chief-directors')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
        Route::get('get-region-of-chiefs/{regionDirector}', 'getRegionOfChiefs');
    });
    Route::apiResource('chief-directors', ChiefDirectorController::class);

    Route::controller(CityController::class)->prefix('cities')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('cities', CityController::class);

//    Route::controller(VehicleController::class)->prefix('vehicles')->group(function () {
//        Route::get('get-all', 'getAll');
//        Route::get('get-filtered', 'getFiltered');
//    });
//    Route::apiResource('vehicles', VehicleController::class);
//
//    Route::controller(DriverController::class)->prefix('drivers')->group(function () {
//        Route::get('get-all', 'getAll');
//        Route::get('get-filtered', 'getFiltered');
//    });
//    Route::apiResource('drivers', DriverController::class);

    Route::controller(TaxOfficeController::class)->prefix('tax-offices')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('tax-offices', TaxOfficeController::class);

    Route::controller(ContractController::class)->prefix('contracts')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('contracts', ContractController::class);

    Route::controller(ShipmentController::class)->prefix('shipments')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('shipments', ShipmentController::class);


});
