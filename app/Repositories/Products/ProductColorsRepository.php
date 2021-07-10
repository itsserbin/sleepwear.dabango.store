<?php

namespace App\Repositories\Products;

use App\Models\ProductsColor as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories
 */
class ProductColorsRepository extends CoreRepository
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
            ->where('product_id', $id)
            ->with('colors')
            ->select(
                'id',
                'color_id',
                'product_id',
            )
            ->get();
    }
}
