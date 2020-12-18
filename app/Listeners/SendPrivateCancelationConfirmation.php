<?php

namespace App\Listeners;

use App\Events\PrivateBookingCanceled;
use App\Mail\PrivateCanceledConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPrivateCancelationConfirmation
{
    
    public function __construct()
    {

    }


    public function handle(PrivateBookingCanceled $event)
    {
        Mail::to($event->booking->email)
        ->bcc(config('greenwiperz.company.email'))
        ->send(new PrivateCanceledConfirmationMail($event->booking)); 
    }
}
