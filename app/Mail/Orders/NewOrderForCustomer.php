<?php

namespace App\Mail\Orders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderForCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        protected int $orderId,
        protected string $full_name
    ) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.order_created.customer')->with([
            'orderId' => $this->orderId,
            'full_name' => $this->full_name
        ]);
    }
}
