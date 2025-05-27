<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleTypeController;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/customers', [CustomerController::class, 'index']);

Route::get('/vehicle-types', [VehicleTypeController::class, 'index']);
