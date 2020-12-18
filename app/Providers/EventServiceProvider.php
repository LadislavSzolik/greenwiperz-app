<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\PrivateBookingConfirmed' => [
            'App\Listeners\SendPrivateBookingConfirmation',
        ],
        'App\Events\PrivateBookingCanceled' => [
            'App\Listeners\SendPrivateCancelationConfirmation',
        ],
        'App\Events\PrivateBookingCompleted' => [
            'App\Listeners\SendPrivateCompletionConfirmation',
        ],
        'App\Events\BusinessBookingEntered' => [
            'App\Listeners\SendBusinessEnteredConfirmation',
        ],        
        'App\Events\BusinessBookingCanceled' => [
            'App\Listeners\SendBusinessCancelationConfirmation',
        ],
        'App\Events\BusinessBookingConfirmed' => [
            'App\Listeners\SendBusinessBookingConfirmation',
        ],
        'App\Events\BusinessBookingCompleted' => [
            'App\Listeners\SendBusinessCompletionConfirmation',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
