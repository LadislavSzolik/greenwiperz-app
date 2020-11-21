<?php

namespace App\Listeners;

use App\Events\BookingCompleted;
use App\Mail\BookingCompletedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCompletionConfirmation
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
     * @param  BookingCompleted  $event
     * @return void
     */
    public function handle(BookingCompleted $event)
    {
        Mail::to($event->booking->customerMail)->send(new BookingCompletedMail($event->booking)); 
    }
}
