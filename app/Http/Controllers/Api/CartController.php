<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShoppingCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** @var ShoppingCart */
    private $shoppingCart;

    public function __construct(ShoppingCart $shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * Показать товары в корзине.
     *
     * @return JsonResponse
     */
    public function list()
    {
        $result = $this->shoppingCart->cartList();

        return $this->returnResponse([
            'success' => true,
            'result' => $result
        ]);
    }

    /**
     * Добавить товар в корзину.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $uuid = $this->shoppingCart->addItem($request->all());

        if (!$uuid) {
            return $this->returnResponse([
                'success' => true,
            ]);
        } else {
            return $this->returnResponse([
                'success' => true,
            ], 201, [], ['name' => 'cart', 'value' => $uuid]);
        }
    }

    /**
     * Обновить товар в козине.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->shoppingCart->updateCart($request->all());

        return $this->returnResponse([
            'success' => true,
        ]);
    }

    /**
     * Удалить товар из корзины.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $this->shoppingCart->deleteItem($request->route('item'));

        return $this->returnResponse([
            'success' => true,
        ]);
    }
}
