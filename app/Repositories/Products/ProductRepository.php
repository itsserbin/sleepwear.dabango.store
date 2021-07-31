<?php

namespace App\Repositories\Products;

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
    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить все товары.
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this
            ->model
            ->with('categories')
            ->where('published', 1)
            ->get();
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
            'published',
            'description',
            'price',
            'discount_price',
            'preview',
            'h1',
            'vendor_code',
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
            'price',
            'published',
            'discount_price',
            'preview',
            'total_sales',
            'h1',
            'created_at',
            'updated_at'
        ];

        return $this
            ->startConditions()
            ->where('published', '1')
            ->select($columns)
            ->orderBy('total_sales','desc')
            ->paginate($perPage);
    }

    /**
     * Увеличить кол-во покупок товара на 1.
     *
     * @param $id
     * @return mixed
     */
    public function updateProductTotalSales($id)
    {
        $model = $this->model::where('id',$id)->select('total_sales')->first();

        return $this->model::where('id', $id)->update(['total_sales' => ++$model->total_sales]);
    }
}
