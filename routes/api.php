<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('user/login', [AuthController::class, 'login'])->name('api.user.login');

Route::middleware(['verifyUserToken'])->group(function () {

    Route::get('regions', [RegionController::class, 'index'])->name('api.regions.index');

    Route::get('communes', [CommuneController::class, 'index'])->name('api.communes.index');

    Route::get('customers', [CustomerController::class, 'show'])->name('api.customers.show');

    Route::post('customers', [CustomerController::class, 'store'])->name('api.customers.store');
});