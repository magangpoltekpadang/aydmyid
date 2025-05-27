<?php

use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard/index');
});

Route::resource('vehicle-type', VehicleTypeController::class)->names([
    'index' => 'VehicleType.index',
    'create' => 'VehicleType.create',
    'store' => 'VehicleType.store',
    'edit' => 'VehicleType.edit',
    'update' => 'VehicleType.update',
    'destroy' => 'VehicleType.destroy',
]);
