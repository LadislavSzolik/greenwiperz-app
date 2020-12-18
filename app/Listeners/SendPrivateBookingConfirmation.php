<?php

namespace App\Listeners;

use App\Events\PrivateBookingConfirmed;
use App\Mail\PrivateBookingConfirmedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPrivateBookingConfirmation
{
 
    public function __construct()
    {
        //
    }

    public function handle(PrivateBookingConfirmed $event)
    {
        Mail::to($event->booking->email)
        ->bcc(config('greenwiperz.company.email'))
        ->send(new PrivateBookingConfirmedMail($event->booking)); 
    }
}
