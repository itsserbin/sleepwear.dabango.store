<?php

namespace App\Repositories;

use App\Models\Clients;
use App\Models\Clients as Model;
use App\Models\Products;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories
 */
class ClientsRepository extends CoreRepository
{
    /** @var OrdersRepository */
    private $OrdersRepository;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->OrdersRepository = app(OrdersRepository::class);
    }

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
     * Получить все продукты вывести в пагинации по 15 шт.
     *
     * @param int|null $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'name',
            'phone',
            'status',
            'number_of_purchases',
            'whole_check',
            'average_check',
            'created_at',
            'updated_at',
        ];

        return $this
            ->startConditions()
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Искать в базе по критериям: ID, Имя и телефон.
     *
     * @param $request
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
            'number_of_purchases',
            'whole_check',
            'average_check',
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
        return $this->model::where('id', $id)->update([
            'name' => $request['name'],
            'status' => $request['status'],
            'comment' => $request['comment'],
            'city' => $request['city'],
            'phone' => $request['phone'],
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
     * Проверить наличие клиента в БД.
     */
    public function checkByPhone($phone)
    {
        return $this->startConditions()->where('phone', $phone)->first();
    }

    /**
     * Записываем нового клиента в базу и создаем заказ.
     *
     * @param $name
     * @param $phone
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createClient($name, $phone)
    {
        $client = new Clients();
        $client->name = $name;
        $client->status = 'Новый';
        $client->phone = $phone;
        $client->number_of_purchases = 1;
        $client->whole_check = '-';
        $client->average_check = '-';
        $client->save();

        return $client;
    }

    /**
     * Обновляем информацию о клиенте и создаем заказ.
     *
     * @param $client
     * @return mixed
     */
    public function updateClient($client)
    {
        $result = $this->startConditions()->where('id', $client)->first();

        ++$result->number_of_purchases;
        $result->whole_check = '-';
        $result->average_check = '-';
        $result->update();

        return $result;
    }
}
