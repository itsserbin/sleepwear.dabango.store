<?php

namespace App\Repositories;

use App\Models\Orders as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
     * @return Model
     */
    public function getById($id)
    {
        return $this->startConditions()->find($id);
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
            'city',
            'product_id',
            'sale_price',
            'created_at',
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
     * Обновить данные клиента.
     *
     * @param $id
     * @param $request
     * @return mixed
     */
    public function update(int $id, array $request)
    {
//        return $this->model::where('id', $id)->update([
//            'status' => $request['status'],
//            'name' => $request['name'],
//            'phone' => $request['phone'],
//            'comment' => $request['comment'],
//            'city' => $request['city'],
//            'sizes' => $request['sizes'],
//            'colors' => $request['colors'],
//            'waybill' => $request['waybill'],
//            'postal_office' => $request['postal_office'],
//            'pay' => $request['pay'],
//        ]);

        return $this->model::where('id', $id)->update($request);

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
}
