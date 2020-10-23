<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); 

Route::middleware(['auth:sanctum', 'verified'])->get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');

Route::post('/payments/store', [PaymentController::class, 'store'])->name('payment.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
