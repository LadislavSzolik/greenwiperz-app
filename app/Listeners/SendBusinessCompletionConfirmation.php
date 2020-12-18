<?php

namespace App\Listeners;

use App\Events\BusinessBookingCompleted;
use App\Mail\BusinessBookingCompletedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBusinessCompletionConfirmation
{

    public function __construct()
    {
        //
    }


    public function handle(BusinessBookingCompleted $event)
    {
        Mail::to($event->booking->email)
        ->bcc(config('greenwiperz.company.email'))
        ->send(new BusinessBookingCompletedMail($event->booking)); 
    }
}
