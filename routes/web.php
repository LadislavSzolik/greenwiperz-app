<?php

use App\Models\Booking;
use App\Mail\BookingConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/prices', function () {
    return view('prices');
})->name('prices');

Route::get('/how-it-works', function () {
    return view('how-it-works');
})->name('how.it.works');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');

Route::post('/payments/handlePaymentSucceeded', [PaymentController::class, 'handlePaymentSucceeded']);
Route::post('/payments/handleCancelPayment', [PaymentController::class, 'handleCancelPayment']);
Route::post('/payments/handleErrorPayment', [PaymentController::class, 'handleErrorPayment']);

Route::middleware(['auth:sanctum', 'verified'])->get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');

// TODO: finish mail testing
Route::get('mailable',function(){
    $booking = Booking::findOrFail(13);
    return new BookingConfirmed($booking);
});
