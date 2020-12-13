<?php

namespace App\Listeners;

use App\Events\CompanyBookingEntered;
use App\Mail\CompanyBookingEnteredMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCompanyEnteredConfirmation
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
     * @param  CompanyBookingEntered  $event
     * @return void
     */
    public function handle(CompanyBookingEntered $event)
    {
        Mail::to($event->booking->email)->bcc(config('greenwiperz.company.email'))->send(new CompanyBookingEnteredMail($event->booking)); 
    }
}
