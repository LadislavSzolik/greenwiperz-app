<?php

namespace App\Listeners;

use App\Events\BusinessBookingEntered;
use App\Mail\BusinessBookingEnteredMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBusinessEnteredConfirmation
{    
    public function __construct()
    {
        //
    }

    public function handle(BusinessBookingEntered $event)
    {
        Mail::to($event->booking->email)
        ->bcc(config('greenwiperz.company.email'))
        ->send(new BusinessBookingEnteredMail($event->booking)); 
    }
}
