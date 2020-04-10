<?php

namespace App\Listeners;

use App\Mail\TestMail;
use Barryvdh\Debugbar\Facade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class TestListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        //$mail = new TestMail($event->model);
        //Mail::to($user)->send(new ChangeCustomerOfferStatus($offer));
        Mail::to($event->user)->send(new TestMail($event->dialog));

    }
}
