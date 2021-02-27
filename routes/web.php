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
use App\Http\Controllers\AppointmentTimeController;
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
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

Route::get('/', function () { return redirect(current_lang());})->name('en.home');

foreach (Config::get('app.all_langs') as $language) {
    Route::prefix($language)->group(function () use ($language) {
        Route::get('/', function () {return view('welcome');})->name($language . '.home');
        Route::get('/prices', function () {return view('prices');})->name($language . '.prices');
        Route::get('/how-it-works', function () {return view('how-it-works');})->name($language . '.how.it.works');
        Route::get('/service-area', function () {return view('service-area');})->name($language . '.service.area');
        Route::get('/about', function () {return view('about');})->name($language . '.about');
        Route::get('/contact', function () {return view('contact');})->name($language . '.contact');
        Route::get('/terms', function () {return view('terms');})->name($language . '.terms');
        Route::get('lang/{locale}', LocalizationController::class)->name($language . '.language');

        // Auth
        $limiter = config('fortify.limiters.login');
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware(['guest'])->name($language . '.login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware(array_filter(['guest', $limiter ? 'throttle:' . $limiter : null,]));
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name($language . '.logout');
        Route::get('/register', [RegisteredUserController::class, 'create'])->middleware(['guest'])->name($language . '.register');
        Route::post('/register', [RegisteredUserController::class, 'store'])->middleware(['guest']);
        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware(['guest'])->name($language . '.password.request');
        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware(['guest'])->name($language . '.password.reset');
        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware(['guest'])->name($language . '.password.email');
        Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware(['guest'])->name($language . '.password.update');
        Route::get('/user/profile', [UserProfileController::class, 'show'])->name($language . '.profile.show');

        // SIGN UP FOR WAITINGLIST
        Route::get('/waitingvisitors/create', [WaitingVisitorController::class, 'create'])->name($language . '.waitingvisitors.create');
        Route::post('/waitingvisitors/store', [WaitingVisitorController::class, 'store'])->name($language . '.waitingvisitors.store');

// RATING
        Route::get('/ratings/{user}', [RatingController::class, 'create'])->name($language . '.ratings.create');
        Route::post('/ratings', [RatingController::class, 'store'])->name($language . '.ratings.store');

// ADMIN
        Route::middleware(['auth:sanctum', 'verified', 'can:manage_bookings'])->group(function () use ($language)  {
            Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name($language . '.bookings.complete');
            Route::post('/comments/{booking}', [BookingCommentController::class, 'store'])->name($language . '.comments.update');
            Route::post('/appointment/{appointment}', [AppointmentTimeController::class, 'store'])->name($language . '.bookingtime.update');
            Route::get('/appointments', Appointments::class)->name($language . '.appointments.index');
            Route::get('/ratings', AdminRatings::class)->name($language . '.ratings.index');
            Route::get('/users', Users::class)->name($language . '.users.index');
            Route::get('/clients', Clients::class)->name($language . '.clients.index');
        });

// AUTH CUSTOMER ZONE
        Route::middleware(['auth:sanctum', 'verified'])->group(function () use ($language) {
            // IMPORTANT: one booking can spread over multiple days, that's why I have show the booking timeslots instead of bookings
            Route::get('/bookings', BookingTimeslots::class)->name($language . '.bookings.index');

            Route::get('/bookings/private/create', CreatePrivateForm::class)->name($language . '.bookings.private.create');
            Route::get('/bookings/company/create', CreateCompanyForm::class)->name($language . '.bookings.company.create');
            Route::get('/bookings/{booking}/private/review', ReviewPrivateForm::class)->name($language . '.bookings.review');
            Route::get('/bookings/{booking}/company/review', ReviewCompanyForm::class)->name($language . '.bookings.company.review');
            Route::get('/bookings/{booking}', ShowBooking::class)->name($language . '.bookings.show');
            Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name($language . '.bookings.destroy');
            Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name($language . '.bookings.cancel');
            Route::get('/bookings/{booking}/invoice', [BookingController::class, 'showInvoice'])->name($language . '.bookings.invoice');
            Route::get('/bookings/{booking}/receipt', [BookingController::class, 'showReceipt'])->name($language . '.bookings.receipt');
            Route::get('/bookings/{booking}/refund', [BookingController::class, 'showRefund'])->name($language . '.bookings.refund');
            Route::get('/cars', Cars::class)->name($language . '.cars.index');
            Route::get('/payments/redirectToDatatrans/{id}', [PaymentController::class, 'redirectToDatatrans'])->name($language . '.payments.redirect');
            Route::get('/termsinapp', function () {return view('terms-inapp');})->name($language . '.terms.inapp');
        });

// Handle datatrans POST
        Route::post('/payments/handlePaymentSucceeded', [PaymentController::class, 'handlePaymentSucceeded'])->name($language . '.handlePaymentSucceeded');
        Route::post('/payments/handlePaymentCanceled', [PaymentController::class, 'handlePaymentCanceled'])->name($language . '.handlePaymentCanceled');
        Route::post('/payments/handlePaymentFailed', [PaymentController::class, 'handlePaymentFailed'])->name($language . '.handlePaymentFailed');

// TODO: Remove from PROD.
        Route::get('mailable', function () {
            $booking = Booking::findOrFail(1);
            return new PrivateBookingConfirmedMail($booking);
        });






    });
}
