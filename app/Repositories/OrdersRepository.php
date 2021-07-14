<?php

namespace App\Repositories;

use App\Models\Orders as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * Class OrdersRepository
 * @package App\Repositories
 */
class OrdersRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить модель для редактирования в админке.
     *
     * @param int @id
     *
     * @return Builder|Builder[]|Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this
            ->startConditions()
            ->with('Product', 'items.product')
            ->find($id);
    }

    /**
     * Вывести все продукты в пагинации по 15 шт.
     *
     * @param int|null $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'name',
            'phone',
            'client_id',
            'product_id',
            'city',
            'comment',
            'sale_price',
            'updated_at',
            'created_at',
        ];

        return $this
            ->startConditions()
            ->with('Clients', 'Product')
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Вывести новые заказы в пагинацию по 15 шт.
     *
     * @param null $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getNewOrdersWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'name',
            'phone',
            'product_id',
            'sale_price',
            'created_at',
        ];

        return $this
            ->startConditions()
            ->where('status', 'Новый')
            ->with('Product')
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Вывести заказы в процессе в пагинацию по 15 шт.
     *
     * @param null $perPage
     * @return mixed
     */
    public function getProcessOrdersWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'name',
            'phone',
            'product_id',
            'sale_price',
            'created_at',
        ];

        return $this
            ->startConditions()
            ->where('status', 'В процессе')
            ->with('Clients', 'Product')
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Вывести заказы переданные поставщику в пагинацию по 15 шт.
     *
     * @param null $perPage
     * @return mixed
     */
    public function getTransferredToSupplierOrdersWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'name',
            'phone',
            'waybill',
            'product_id',
            'sale_price',
            'created_at',
        ];

        return $this
            ->startConditions()
            ->where('status', 'Передан поставщику')
            ->with('Clients', 'Product')
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Вывести заказы на почте в пагинацию по 15 шт.
     *
     * @param null $perPage
     * @return mixed
     */
    public function getPostOfficeOrdersWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'name',
            'phone',
            'waybill',
            'city',
            'product_id',
            'sale_price',
            'updated_at',
        ];

        return $this
            ->startConditions()
            ->where('status', 'На почте')
            ->with('Clients', 'Product')
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Вывести выполненные заказы в пагинацию по 15 шт.
     *
     * @param null $perPage
     * @return mixed
     */
    public function getDoneOrdersWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'name',
            'phone',
            'waybill',
            'pay',
            'city',
            'product_id',
            'sale_price',
            'created_at',
        ];

        return $this
            ->startConditions()
            ->where('status', 'Выполнен')
            ->with('Clients', 'Product')
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Вывести возвращеные заказы в пагинацию по 15 шт.
     *
     * @param null $perPage
     * @return mixed
     */
    public function getReturnOrdersWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'name',
            'phone',
            'comment',
            'product_id',
            'sale_price',
            'created_at',
        ];

        return $this
            ->startConditions()
            ->where('status', 'Возврат')
            ->with('Clients', 'Product')
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Вывести отмененные заказы в пагинацию по 15 шт.
     *
     * @param null $perPage
     * @return mixed
     */
    public function getCancelOrdersWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'name',
            'phone',
            'comment',
            'product_id',
            'sale_price',
            'updated_at',
        ];

        return $this
            ->startConditions()
            ->where('status', 'Отменен')
            ->with('Clients', 'Product')
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Создание нового заказа.
     *
     * @param $data
     * @return mixed
     */
    public function create($data, $client_id)
    {
        $order = new $this->model;

        $order->name = $data['name'];
        $order->phone = $data['phone'];
        $order->city = $data['city'];
        $order->postal_office = $data['postal_office'];
        $order->client_id = $client_id;
        $order->product_name = '-';
        $order->trade_price = '-';
        $order->sale_price = '-';
        $order->profit = '-';
        $order->status = 'Новый';

        $order->save();

        return $order;
    }

    public function find(int $id)
    {
        return $this->model::where('id', $id)->with('items', 'items.product')->first();
    }

    /**
     * Обновить данные клиента.
     *
     * @param $id
     * @param $request
     * @return mixed
     */
    public function update(int $id, array $request)
    {
        return $this->model::where('id', $id)->update([
            'status' => $request[0]['status'],
            'name' => $request[0]['name'],
            'phone' => $request[0]['phone'],
            'comment' => $request[0]['comment'],
            'city' => $request[0]['city'],
            'waybill' => $request[0]['waybill'],
            'postal_office' => $request[0]['postal_office'],
            'modified_by' => $request[1]['userName'],
        ]);


    }

    /**
     * Удалить клиента из базы.
     *
     * @param int $id
     * @return int
     */
    public function destroy(int $id)
    {
        return $this->model::destroy($id);
    }

    /**
     * Посчитать кол-во клиентов за сегодня.
     *
     * @return mixed
     */
    public function countOrdersToday()
    {
        return $this
            ->startConditions()
            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->count();
    }

    /**
     * Искать совпадения по базе по: ID, Имя и телефон.
     *
     * @param $search
     * @param null $perPage
     * @return mixed
     */
    public function search($search, $perPage = null)
    {
        $columns = [
            'id',
            'name',
            'phone',
            'status',
            'product_id',
            'client_id',
            'sale_price',
            'created_at',
            'updated_at',
        ];

        return $this
            ->startConditions()
            ->select($columns)
            ->where('name', 'LIKE', "%$search%")
            ->orWhere('phone', 'LIKE', "%$search%")
            ->orWhere('id', 'LIKE', "%$search%")
            ->orderBy('created_at', 'desc')
            ->with('product')
            ->paginate($perPage);
    }

    /**
     * Подсчитать сумму всех заказов пользователя, с учетом нового заказа.
     *
     * @param $phone
     * @param $sale_price
     * @return mixed
     */
    public function sumAllClientOrders($phone, $sale_price)
    {
        return $this
                ->startConditions()
                ->where('phone', $phone)
                ->sum('sale_price') + $sale_price;
    }
}
