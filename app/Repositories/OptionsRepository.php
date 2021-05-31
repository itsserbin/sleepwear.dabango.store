<?php

namespace App\Repositories;

use App\Models\Options;
use App\Models\Options as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories
 */
class OptionsRepository extends CoreRepository
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
    public function getIndex()
    {
        $model = $this->startConditions()->find(1);

        if ($model !== null) {
            $model = $this->startConditions()
                ->find(1)
                ->select(
                    'schedule',
                    'email',
                    'phone',
                    'facebook',
                    'instagram',
                    'telegram',
                    'viber',
                    'whatsapp',
                    'fb_messenger')
                ->get();
        } else {
            $model = new Options();
            $model->id = 1;
            $model->save();
        }
        return $model;
    }


    /**
     * Получаем скрипты для редактирования в админке.
     *
     * @return mixed
     */
    public function getScripts()
    {
        $model = $this->startConditions()->find(1);

        if ($model !== null) {
            $model = $this->startConditions()
                ->find(1)
                ->select(
                    'head_scripts',
                    'after_body_scripts',
                    'footer_scripts')
                ->get();
        } else {
            $model = new $this->model;
            $model->save();
        }
        return $model;

    }

    /**
     * Обновить настройки.
     *
     * @param $request
     * @return mixed
     */
    public function update($request)
    {
        return $this->model->find(1)->update($request->all());
    }
}
