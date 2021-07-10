<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItems;
use App\Repositories\CartRepository;
use App\Repositories\CartItemsRepository;
use App\Repositories\Products\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;


class ShoppingCart
{
    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var CartItemsRepository
     */
    private $cartItemsRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var string
     */
    private $cookie;

    /**
     * @var string
     */
    private $uuid;

    public function __construct(
        CartRepository $cartRepository,
        CartItemsRepository $cartItemsRepository,
        ProductRepository $productRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemsRepository = $cartItemsRepository;
        $this->productRepository = $productRepository;
        $this->cookie = Cookie::get('cart');
        $this->uuid = (string)Str::uuid();
    }

    /**
     * Get cart list
     *
     * @return array
     */
    public function cartList()
    {
        $list = [];
        $total_price = 0;
        $total_quantity = 0;

        if (!$this->cookie) {
            return [
                'list' => [],
                'totalCount' => 0,
                'totalPrice' => 0,
            ];
        }

        /* @var $cart Cart */
        $cart = $this->cartRepository->find($this->cookie);

        if (!$cart) {
            return [
                'list' => [],
                'totalCount' => 0,
                'totalPrice' => 0,
            ];
        }

        if (!$cart->items) {
            return [
                'list' => [],
                'totalCount' => 0,
                'totalPrice' => 0,
            ];
        }

        /** @var $item CartItems */
        foreach ($cart->items as $item) {
            if ($item->product) {
                $total_price += ($item->product->discount_price ? $item->product->discount_price : $item->product->price) * $item->count;
                $total_quantity += $item->count;

                $list[] = [
                    'id' => $item->product->id,
                    'alias' => route('product', ['alias' => $item->product->alias, 'id' => $item->product->id]),
                    'name' => $item->product->h1,
                    'image' => asset($item->product->preview),
                    'count' => $item->count,
                    'size' => $item->size,
                    'color' => $item->color,
                    'price' => $item->product->discount_price ? $item->product->discount_price : $item->product->price,
                    'maxcount' => 50,
                ];
            }
        }

        return [
            'list' => $list,
            'totalCount' => $total_quantity,
            'totalPrice' => number_format($total_price, 2, '.', ''),
        ];
    }

    /**
     * Add new product to cart or update
     *
     * @param $data
     * @return bool|string
     */
    public function addItem($data)
    {
        /* @var $cart Cart */
        $cart = $this->cartRepository->find($this->cookie);

        if (!$cart) {
            /* @var $cart Cart */
            $cart = $this->cartRepository->create($this->uuid);

            $this->cartItemsRepository->create($data, $cart->id);

            return $this->uuid;
        }

        /* @var $item CartItems */
        $item = $this->cartItemsRepository->getItem($data['item_id'], $cart->id);

        if ($item) {
            $data['count'] = $data['count'] + $item->count;

            $this->cartItemsRepository->update($data, $cart->id);
        } else {
            $this->cartItemsRepository->create($data, $cart->id);
        }

        return false;
    }

    /**
     * Update count current cart
     *
     * @param $data
     * @return bool
     */
    public function updateCart($data)
    {
        /* @var $cart Cart */
        $cart = $this->cartRepository->find($this->cookie);

        if (!$cart) {
            return false;
        }

        $this->cartItemsRepository->update($data, $cart->id);
    }

    /**
     * Delete item from cart
     *
     * @param $item
     */
    public function deleteItem($item)
    {
        /* @var $cart Cart */
        $cart = $this->cartRepository->find($this->cookie);

        $this->cartItemsRepository->destroy($cart->id, $item);
    }
}
