<?php


use App\Models\Booking;
use App\Events\BookingConfirmed;
use App\Mail\BookingConfirmedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\CanceledConfirmationMail;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Livewire\DatatransRedirectTester;
use App\Http\Controllers\LocalizationController;

// GUEST ZONE
Route::get('lang/{locale}', LocalizationController::class)->name('language');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/prices', function () {
    return view('prices');
})->name('prices');

Route::get('/how-it-works', function () {
    return view('how-it-works');
})->name('how.it.works');

Route::get('/service-area', function () {
    return view('service-area');
})->name('service.area');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// AUTH USER ZONE
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
Route::middleware(['auth:sanctum', 'verified'])->post('/bookings/{booking}/delete', [BookingController::class, 'destroy'])->name('bookings.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/{booking}/invoice', [BookingController::class, 'showInvoice'])->name('bookings.invoice');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/{booking}/receipt', [BookingController::class, 'showReceipt'])->name('bookings.receipt');
Route::middleware(['auth:sanctum', 'verified'])->get('/bookings/{booking}/refund', [BookingController::class, 'showRefund'])->name('bookings.refund');

Route::middleware(['auth:sanctum', 'verified'])->get('/payments/redirectToDatatrans/{id}', [PaymentController::class, 'redirectToDatatrans'])->name('payments.redirect');
Route::post('/payments/handlePaymentSucceeded', [PaymentController::class, 'handlePaymentSucceeded']);
Route::post('/payments/handlePaymentCanceled', [PaymentController::class, 'handlePaymentCanceled']);
Route::post('/payments/handlePaymentFailed', [PaymentController::class, 'handlePaymentFailed']);


Route::middleware(['auth:sanctum', 'verified'])->get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');

// TODO: finish mail testing
Route::get('mailable',function(){
    $booking = Booking::findOrFail(1);    
    return new CanceledConfirmationMail($booking);
});


