<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Order extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $phone;
    protected $orderItems;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.shipped')->with([
            'name' => $this->name,
            'phone' => $this->phone,
        ])->subject('Новая заявка на купальник');
    }
}
