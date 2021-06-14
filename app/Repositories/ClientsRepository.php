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
}
