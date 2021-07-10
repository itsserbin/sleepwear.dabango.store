<?php

namespace App\Repositories;

use App\Models\CartItems;
use App\Models\OrderItems as Model;
use App\Repositories\Products\ProductRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class OrderItemsRepository
 * @package App\Repositories
 */
class OrderItemsRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param $cartItems
     * @param $orderId
     * @return bool
     */
    public function create($cartItems, $orderId)
    {
        $productRepository = new ProductRepository();

        foreach ($cartItems as $item) {
            $product = $productRepository->getById($item->product_id);

            $orderItem = new $this->model;
            $orderItem->order_id = $orderId;
            $orderItem->product_id = $product->id;
            $orderItem->count = $item->count;
            $orderItem->size = $item->size;
            $orderItem->color = $item->color;
            $orderItem->trade_price = $product->trade_price;
            $orderItem->sale_price = $product->discount_price ? $product->discount_price : $product->price;
            $orderItem->profit = $orderItem->sale_price - $product->trade_price;
            $orderItem->pay = false;
            $orderItem->provider_id = $product->Providers->id;

            $orderItem->save();
        }

        return true;
    }

    /**
     * Получить элемент заказа по ID.
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->first();
    }

    /**
     * Получить элемент заказа по ID заказа.
     *
     * @param $id
     * @return Builder[]|Collection
     */
    public function getByOrderId($id)
    {
        return $this->startConditions()
            ->with('product.providers')
            ->where('order_id', $id)
            ->get();
    }

    /**
     * Удаление товара в заказе.
     *
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        return $this->model::destroy($id);
    }

    /**
     * Вывести в пагинацию заказы, ожидающие выплаты от поставщика.
     *
     * @param null $perPage
     * @return mixed
     */
    public function PaymentsAwaiting($perPage = null)
    {
        return $this
            ->startConditions()
            ->join('orders', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where([
                        ['status', '=', 'Выполнен'],
                        ['order_items.pay', '=', false]
                    ]);
            })
            ->join('products', function ($join) {
                $join->on('order_items.product_id', '=', 'products.id');
            })
            ->join('providers', function ($join) {
                $join->on('order_items.provider_id', '=', 'providers.id');
            })
            ->select(
                'order_items.id',
                'order_items.order_id',
                'order_items.provider_id',
                'order_items.product_id',
                'order_items.pay',
                'order_items.profit',
                'products.h1 as product_h1',
                'providers.name as provider_name',
            )
            ->paginate($perPage);
    }

    public function paymentsReceived($perPage = null)
    {
        return $this
            ->startConditions()
            ->join('orders', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where([
                        ['status', '=', 'Выполнен'],
                        ['order_items.pay', '=', true]
                    ]);
            })
            ->join('products', function ($join) {
                $join->on('order_items.product_id', '=', 'products.id');
            })
            ->join('providers', function ($join) {
                $join->on('order_items.provider_id', '=', 'providers.id');
            })
            ->select(
                'order_items.id',
                'order_items.order_id',
                'order_items.provider_id',
                'order_items.product_id',
                'order_items.pay',
                'order_items.profit',
                'products.h1 as product_h1',
                'providers.name as provider_name',
            )
            ->paginate($perPage);
    }

    public function allPayments($perPage)
    {
        return $this
            ->startConditions()
            ->join('orders', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where([
                        ['status', '=', 'Выполнен'],
                    ]);
            })
            ->join('products', function ($join) {
                $join->on('order_items.product_id', '=', 'products.id');
            })
            ->join('providers', function ($join) {
                $join->on('order_items.provider_id', '=', 'providers.id');
            })
            ->select(
                'order_items.id',
                'order_items.order_id',
                'order_items.provider_id',
                'order_items.product_id',
                'order_items.pay',
                'order_items.profit',
                'products.h1 as product_h1',
                'providers.name as provider_name',
            )
            ->paginate($perPage);
    }

    /**
     * Обновить статус выплаты от поставщика.
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updatePayStatus($id, $data)
    {
        return $this->model::where('id', $id)->update(['pay' => $data['pay']]);
    }

    /**
     * Обновить информацию о элементе заказа.
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->model::where('id', $id)->update([
            'count' => $data['count'],
            'size' => json_encode($data['size']),
            'color' => json_encode($data['color'])
        ]);
    }
}
