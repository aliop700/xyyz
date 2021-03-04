<?php

namespace App\Listeners;

use App\Events\OrderMade;
use App\Mail\OrderMadeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderMail
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
     * @param  OrderMade  $event
     * @return void
     */
    public function handle(OrderMade $event)
    {
        
        // $order = $event->order;
        // $user = $event->user;

        // Mail::to($user->email)->send(new OrderMadeMail($order, $user));
    }
}
