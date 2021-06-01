<?php

namespace App\Repositories\Bookkeeping;

use App\Models\Bookkeeping\OrdersDay as Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories
 */
class OrdersDaysRepository extends CoreRepository
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

    public function ShowStatisticsForTheWeek()
    {
        return $this->startConditions()
            ->whereDate('date','>',Carbon::today()->subDays(7)->format('Y-m-d'))
            ->get();
    }

}
