<?php

namespace App\Listeners;

use App\Events\PrivateBookingCompleted;
use App\Mail\PrivateBookingCompletedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPrivateCompletionConfirmation
{    
    public function __construct() {        
    }

    
    public function handle(PrivateBookingCompleted $event)
    {
        Mail::to($event->booking->email)
        ->bcc(config('greenwiperz.company.email'))
        ->send(new PrivateBookingCompletedMail($event->booking)); 
    }
}
