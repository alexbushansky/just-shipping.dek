<?php

namespace App\Mail;

use App\Models\CustomerOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeCustomerOfferStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $offer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CustomerOffer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Ваш заказ принят')->view('emails.customer-offer');
    }
}
