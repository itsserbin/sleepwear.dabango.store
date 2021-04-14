<?php

namespace App\Repositories;

use App\Models\Products as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories
 */
class ProductRepository extends CoreRepository
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
    public function getEdit($id)
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
            'status',
            'description',
            'cost',
            'sale_cost',
            'preview',
            'h1',
            'created_at',
            'updated_at',
        ];

        return $this
            ->startConditions()
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    public function getProduct($id)
    {
        return $this->model::find($id);
    }

    public function getItemsWithPaginateOnProduction($perPage = null)
    {
        $columns = [
            'id',
            'status',
            'description',
            'cost',
            'sale_cost',
            'preview',
            'h1',
            'created_at',
        ];

        return $this
            ->startConditions()
            ->where('status', '1')
            ->select($columns)
            ->orderBy('updated_at', 'DESC')
            ->paginate($perPage);
    }
}
