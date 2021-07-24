<?php

namespace App\Services;

use App\Mail\NewOrder;
use App\Mail\Order;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Orders;
use App\Repositories\CartItemsRepository;
use App\Repositories\CartRepository;
use App\Repositories\ClientsRepository;
use App\Repositories\OrderItemsRepository;
use App\Repositories\OrdersRepository;
use App\Repositories\Products\ProductRepository;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderCheckout
{
    /** @var CartRepository */
    private $cartRepository;

    /** @var CartItemsRepository */
    private $cartItemsRepository;

    /** @var OrdersRepository */
    private $ordersRepository;

    /** @var OrderItemsRepository */
    private $orderItemsRepository;

    /** @var ProductRepository */
    private $productRepository;

    /** @var ClientsRepository */
    private $clientsRepository;

    /** @var string */
    private $cookie;

    public function __construct(
        CartRepository $cartRepository,
        ProductRepository $productRepository,
        ClientsRepository $clientsRepository,
        CartItemsRepository $cartItemsRepository,
        OrdersRepository $ordersRepository,
        OrderItemsRepository $orderItemsRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->clientsRepository = $clientsRepository;
        $this->cartItemsRepository = $cartItemsRepository;
        $this->ordersRepository = $ordersRepository;
        $this->orderItemsRepository = $orderItemsRepository;
        $this->cookie = Cookie::get('cart');
    }

    public function createOrder(array $data)
    {
        $cart = $this->findCart();

        $name = $data['name'];
        $phone = $data['phone'];
        $phone = preg_replace('/[^0-9]/', '', $data['phone']);
        $phone = '+' . $phone;

        $client = $this->clientsRepository->checkByPhone($phone);

        if ($cart) {
            $items = $this->findCartItems($cart->id);

            if (!isset($client)) {
                $client = $this->clientsRepository->createClient($name, $phone);
            } else {
                $client = $this->clientsRepository->updateClient($client->id);
            }

            $order = $this->ordersRepository->create($data, $client->id);


            if ($this->orderItemsRepository->create($items, $order->id)) {
                foreach ($items as $item){
                    $this->productRepository->updateProductTotalSales($item->product_id);
                }
                $this->deleteCartItems($cart->id);
            }

            try {
                Mail::to(['serbin.ssd@gmail.com',
                    'youbrand_top@ukr.net',
                    'karina.youbrand@gmail.com'
                ])->send(new Order($name, $phone));
            } catch (\Throwable $exception) {
                Log::error($exception->getMessage());
            }
        }

    }


    public function findCart()
    {
        return $this->cartRepository->find($this->cookie);
    }

    public function findCartItems(int $cartId)
    {
        return $this->cartItemsRepository->find($cartId);
    }

    public function deleteCartItems(int $cartId)
    {
        return $this->cartItemsRepository->destroyCartItems($cartId);
    }
}
