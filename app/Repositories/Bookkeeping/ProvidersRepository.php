<?php

namespace App\Repositories\Bookkeeping;

use App\Models\Bookkeeping\Providers as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories
 */
class ProvidersRepository extends CoreRepository
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
        return $this
            ->startConditions()
            ->find($id);
    }

    /**
     * Получить поставщиков для выбора на странице товара.
     *
     * @return mixed
     */
    public function getProvidersToProduct()
    {
        return $this
            ->startConditions()
            ->select('id','name')
            ->get();
    }

    /**
     * Вывести всех поставщиков в пагинации по 15 шт.
     *
     * @param null $perPage
     * @return mixed
     */
    public function getAllWithPaginate($perPage = null)
    {
        return $this
            ->startConditions()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Создать нового поставщика.
     *
     * @param array $request
     * @return mixed
     */
    public function create(array $request)
    {
        return $this->model->create($request);
    }

    /**
     * Обновить данные поставщика.
     *
     * @param int $id
     * @param array $request
     * @return mixed
     */
    public function update(int $id, array $request)
    {
        return $this->model::where('id', $id)->update($request);
    }

    /**
     * Удалить поставщика.
     *
     * @param int $id
     * @return int
     */
    public function destroy(int $id)
    {
        return $this->model::destroy($id);
    }
}
