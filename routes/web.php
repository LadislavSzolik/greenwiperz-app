<?php

use App\Models\Booking;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\WaitingVisitorController;
use App\Http\Controllers\BookingCommentController;
use App\Http\Controllers\RatingController;
use App\Http\Livewire\Appointment\Appointments;
use App\Http\Livewire\Booking\CreateCompanyForm;
use App\Http\Livewire\Booking\CreatePrivateForm;
use App\Http\Livewire\Booking\ReviewCompanyForm;
use App\Http\Livewire\Booking\ReviewPrivateForm;
use App\Http\Livewire\Booking\ShowBooking;
use App\Http\Livewire\Cars;
use App\Http\Livewire\Clients;
use App\Http\Livewire\Bookingtimeslot\BookingTimeslots;
use App\Http\Livewire\Rating\AdminRatings;
use App\Http\Livewire\Users;
use App\Mail\PrivateBookingConfirmedMail;


foreach (Config::get('app.all_langs') as $language) {
    Route::prefix($language)->group(function() use ($language) {
        Route::get('/', function () { return view('welcome'); })->name($language.'.home');
        Route::get('/prices', function () { return view('prices'); })->name($language.'.prices');
        Route::get('/how-it-works', function () { return view('how-it-works'); })->name($language.'.how.it.works');
        Route::get('/service-area', function () { return view('service-area');})->name($language.'.service.area');
        Route::get('/about', function () {return view('about');})->name($language.'.about');
        Route::get('/contact', function () {return view('contact');})->name($language.'.contact');
        Route::get('/terms', function () {return view('terms');})->name($language.'.terms');
    });
}

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
    Route::get('/ratings', AdminRatings::class)->name('ratings.index');
    Route::get('/users', Users::class)->name('users.index');
    Route::get('/clients', Clients::class)->name('clients.index');
});

// AUTH CUSTOMER ZONE
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // IMPORTANT: one booking can spread over multiple days, that's why I have show the booking timeslots instead of bookings
    Route::get('/bookings', BookingTimeslots::class)->name('bookings.index');

    Route::get('/bookings/private/create', CreatePrivateForm::class)->name('bookings.private.create');
    Route::get('/bookings/company/create', CreateCompanyForm::class)->name('bookings.company.create');
    Route::get('/bookings/{booking}/private/review', ReviewPrivateForm::class)->name('bookings.review');
    Route::get('/bookings/{booking}/company/review', ReviewCompanyForm::class)->name('bookings.company.review');
    Route::get('/bookings/{booking}', ShowBooking::class)->name('bookings.show');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/bookings/{booking}/invoice', [BookingController::class, 'showInvoice'])->name('bookings.invoice');
    Route::get('/bookings/{booking}/receipt', [BookingController::class, 'showReceipt'])->name('bookings.receipt');
    Route::get('/bookings/{booking}/refund', [BookingController::class, 'showRefund'])->name('bookings.refund');
    Route::get('/cars', Cars::class)->name('cars.index');
    Route::get('/payments/redirectToDatatrans/{id}', [PaymentController::class, 'redirectToDatatrans'])->name('payments.redirect');
    Route::get('/termsinapp', function () {return view('terms-inapp');})->name('terms.inapp');
});

// Handle datatrans POST
Route::post('/payments/handlePaymentSucceeded', [PaymentController::class, 'handlePaymentSucceeded']);
Route::post('/payments/handlePaymentCanceled', [PaymentController::class, 'handlePaymentCanceled']);
Route::post('/payments/handlePaymentFailed', [PaymentController::class, 'handlePaymentFailed']);

// TODO: Remove from PROD.
Route::get('mailable',function(){
    $booking = Booking::findOrFail(1);
    return new PrivateBookingConfirmedMail($booking);
});


