<?php

namespace App\Listeners;

use App\Events\BusinessBookingConfirmed;
use App\Mail\BusinessBookingConfirmedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBusinessBookingConfirmation
{

    public function __construct()
    {
        //
    }


    public function handle(BusinessBookingConfirmed $event)
    {
        Mail::to($event->booking->email)
        ->bcc(config('greenwiperz.company.email'))
        ->send(new BusinessBookingConfirmedMail($event->booking)); 
    }
}
