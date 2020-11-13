<?php

namespace App\Listeners;

use App\Events\BookingCanceled;
use Illuminate\Support\Facades\Mail;
use App\Mail\CanceledConfirmationMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCancelationConfirmation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingCanceled  $event
     * @return void
     */
    public function handle(BookingCanceled $event)
    {
        Mail::to(auth()->user()->email)->send(new CanceledConfirmationMail( $event->booking)); 
    }
}
