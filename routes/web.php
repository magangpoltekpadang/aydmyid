<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembershipPackageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;



Route::resource('/', DashboardController::class);
Route::resource('vehicle-type', VehicleTypeController::class);
Route::resource('role', RoleController::class);
Route::resource('membership-package', MembershipPackageController::class);
