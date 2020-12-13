<?php

namespace App\Listeners;

use App\Events\CompanyBookingConfirmed;
use App\Mail\CompanyBookingConfirmedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCompanyBookingConfirmation
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
     * @param  CompanyBookingConfirmed  $event
     * @return void
     */
    public function handle(CompanyBookingConfirmed $event)
    {
        Mail::to($event->booking->email)->bcc(config('greenwiperz.company.email'))->send(new CompanyBookingConfirmedMail($event->booking)); 
    }
}
