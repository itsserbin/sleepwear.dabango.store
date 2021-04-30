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
    protected $sizes;
    protected $url;
    protected $product;
    protected $product_name;
    protected $colors;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone, $sizes, $url, $product_name, $product, $colors)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->sizes = $sizes;
        $this->url = $url;
        $this->product = $product;
        $this->product_name = $product_name;
        $this->colors = $colors;
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
            'sizes' => $this->sizes,
            'url' => $this->url,
            'product' => $this->product,
            'product_name' => $this->product_name,
            'colors' => $this->colors,
        ])->subject('Новая заявка на купальник');
    }
}
