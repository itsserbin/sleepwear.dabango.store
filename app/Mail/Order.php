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
    protected $size;
    protected $url;
    protected $product;
    protected $product_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone, $size, $url, $product_name, $product)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->size = $size;
        $this->url = $url;
        $this->product = $product;
        $this->product_name = $product_name;
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
            'size' => $this->size,
            'url' => $this->url,
            'product' => $this->product,
            'product_name' => $this->product_name,
        ])->subject('Новая заявка на купальник');;
    }
}
