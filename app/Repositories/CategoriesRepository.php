<?php

namespace App\Repositories;

use App\Models\Categories as Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CategoriesRepository
 * @package App\Repositories
 */
class CategoriesRepository extends CoreRepository
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
     * Получить все категории и вывести в пагинации по 15 шт.
     *
     * @param int|null $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        return $this
            ->model
            ->select(
                'id',
                'title',
                'slug',
                'parent_id',
                'published',
                'meta_title',
                'meta_description',
                'meta_keyword',
                'created_at',
                'updated_at',
                'modified_by',
            )
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Получаем ID и название всех категорий.
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this
            ->startConditions()
            ->select(
                'id',
                'title',
                'parent_id'
            )->get();
    }

    /**
     * Получаем ID и название всех категорий для вывода в фид.
     *
     * @return mixed
     */
    public function getAllToFeed()
    {
        return $this
            ->startConditions()
            ->where('published', true)
            ->select(
                'id',
                'title',
                'parent_id',
                'slug',
                'updated_at',
            )->get();
    }

    /**
     * Получаем ID, превью и название всех категорий для выводе на проде.
     *
     * @return mixed
     */
    public function getAllOnProd()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'preview'
        ];

        return $this
            ->startConditions()
            ->select($columns)
            ->where('published', true)
            ->orderBy('created_at','desc')
            ->get();
    }

    /**
     * Создание новой категории.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $model = new $this->model;
        $model->title = $data[0]['title'];
        $model->slug = $data[0]['slug'];
        $model->parent_id = $data[0]['parent_id'];
        $model->published = $data[0]['published'];
        $model->meta_title = $data[0]['meta_title'];
        $model->meta_description = $data[0]['meta_description'];
        $model->meta_keyword = $data[0]['meta_keyword'];
        $model->preview = $data[0]['preview'];
        $model->created_by = (int)$data[1]['userName'];

        return $model->save();
    }

    /**
     * Обновление данных категории.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->model->find($id)->update([
            'title' => $data[0]['title'],
            'slug' => $data[0]['slug'],
            'parent_id' => $data[0]['parent_id'],
            'published' => $data[0]['published'],
            'meta_title' => $data[0]['meta_title'],
            'meta_description' => $data[0]['meta_description'],
            'meta_keyword' => $data[0]['meta_keyword'],
            'preview' => $data[0]['preview'],
            'modified_by' => (int)$data[1]['userName'],
        ]);
    }

    /**
     * Удалить категорию по ID.
     *
     * @param int $id
     * @return int
     */
    public function destroy(int $id)
    {
        return $this->model::destroy($id);
    }

    /**
     * Получить категорию по Slug для вывода на проде.
     *
     * @param $slug
     * @return mixed
     */
    public function getCategoryOnProduction($slug)
    {
        return $this
            ->startConditions()
            ->with('products')
            ->where('slug', $slug)
            ->first();
    }


    /**
     * Получить продукты из опеределенной категории.
     * Поиск по Slug.
     *
     * @param $slug
     * @param $perPage
     * @return mixed
     */
    public function getCategoryProductsOnProduction($slug, $perPage)
    {
        $category = $this
            ->startConditions()
            ->where('slug', $slug)
            ->first();

        return $category->products()->paginate($perPage);
    }
}
