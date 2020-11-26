<?php


use App\Models\Booking;
use App\Mail\BookingCompletedMail;
use App\Mail\BookingConfirmedMail;
use Illuminate\Support\Facades\Route;
use App\Mail\CanceledConfirmationMail;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\WaitingVisitorController;
use App\Http\Controllers\BookingCommentController;
use App\Http\Controllers\RatingController;
use App\Http\Livewire\Appointments;
use App\Http\Livewire\Bookings;
use App\Http\Livewire\Clients;
use App\Http\Livewire\ReviewBooking;
use App\Http\Livewire\ShowRatings;
use App\Http\Livewire\Users;

// VISITOR ZONE
Route::get('lang/{locale}', LocalizationController::class)->name('language');
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/prices', function () { return view('prices'); })->name('prices');
Route::get('/how-it-works', function () { return view('how-it-works'); })->name('how.it.works');
Route::get('/service-area', function () { return view('service-area');})->name('service.area');
Route::get('/about', function () {return view('about');})->name('about');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/terms', function () {return view('terms');})->name('terms');

// SIGN UP FOR WAITINGLIST
Route::get('/waitingvisitors/create', [WaitingVisitorController::class, 'create'])->name('waitingvisitors.create');
Route::post('/waitingvisitors/store', [WaitingVisitorController::class, 'store'])->name('waitingvisitors.store');
// RATING
Route::get('/ratings/{user}', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// ADMIN
Route::middleware(['auth:sanctum', 'verified','can:manage_bookings'])->group(function () {    
    Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
    Route::post('/comments/{booking}', [BookingCommentController::class, 'store']);
    Route::get('/appointments', Appointments::class)->name('appointments.index');
    Route::get('/ratings', ShowRatings::class)->name('ratings.index');
    Route::get('/users', Users::class)->name('users.index');
    Route::get('/clients', Clients::class)->name('clients.index');
});

// AUTH CUSTOMER ZONE
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/termsinapp', function () {return view('terms-inapp');})->name('terms.inapp');
    Route::get('/bookings', Bookings::class)->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/review', ReviewBooking::class)->name('bookings.review');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/bookings/{booking}/invoice', [BookingController::class, 'showInvoice'])->name('bookings.invoice');
    Route::get('/bookings/{booking}/receipt', [BookingController::class, 'showReceipt'])->name('bookings.receipt');
    Route::get('/bookings/{booking}/refund', [BookingController::class, 'showRefund'])->name('bookings.refund');
    Route::get('/payments/redirectToDatatrans/{id}', [PaymentController::class, 'redirectToDatatrans'])->name('payments.redirect');   
});
Route::post('/payments/handlePaymentSucceeded', [PaymentController::class, 'handlePaymentSucceeded']);
Route::post('/payments/handlePaymentCanceled', [PaymentController::class, 'handlePaymentCanceled']);
Route::post('/payments/handlePaymentFailed', [PaymentController::class, 'handlePaymentFailed']);

// TODO: finish mail testing
Route::get('mailable',function(){
    $booking = Booking::findOrFail(9);   
    //return new BookingConfirmedMail($booking);
    //return new CanceledConfirmationMail($booking);
    return new BookingConfirmedMail($booking);
});


