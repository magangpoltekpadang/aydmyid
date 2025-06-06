<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MembershipPackageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationStatusesController;
use App\Http\Controllers\NotificationTypeController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransactionPaymentController;
use App\Http\Controllers\TransactionServiceController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;



Route::resource('/', DashboardController::class);
Route::resource('vehicle-type', VehicleTypeController::class);
Route::resource('role', RoleController::class);
Route::resource('membership-package', MembershipPackageController::class);
Route::resource('notification-status', NotificationStatusesController::class);
Route::resource('notification-type', NotificationTypeController::class);
Route::resource('outlet', OutletController::class);
Route::resource('payment-method', PaymentMethodController::class);
Route::resource('payment-status', PaymentStatusController::class);
Route::resource('service-type', ServiceTypeController::class);
Route::resource('notification', NotificationController::class);
Route::resource('customer', CustomerController::class);
Route::resource('expense', ExpenseController::class);
Route::resource('service', ServiceController::class);
Route::resource('shift', ShiftController::class);
Route::resource('staff', StaffController::class);
Route::resource('transaction-payment', TransactionPaymentController::class);
Route::resource('transaction-service', TransactionServiceController::class);