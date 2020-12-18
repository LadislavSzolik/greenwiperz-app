<?php

namespace App\Listeners;

use App\Events\BusinessBookingCanceled;
use App\Mail\BusinessCanceledConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBusinessCancelationConfirmation
{
 
    public function __construct()
    {
        
    }

    public function handle(BusinessBookingCanceled $event)
    {
        Mail::to($event->booking->email)
        ->bcc(config('greenwiperz.company.email'))
        ->send(new BusinessCanceledConfirmationMail($event->booking)); 
    }
}
