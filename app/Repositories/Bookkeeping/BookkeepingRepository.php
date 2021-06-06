<?php

namespace App\Repositories\Bookkeeping;

use App\Models\Bookkeeping\OrdersDay as Model;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories
 */
class BookkeepingRepository extends CoreRepository
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
     * Показать статистику за все время.
     *
     * @param null $perPage
     * @return mixed
     */
    public function ShowAllStatistics($perPage = null)
    {
        return $this
            ->startConditions()
            ->orderBy('date', 'desc')
            ->paginate($perPage);
    }

    /**
     * Показать статистику за определенные дни.
     *
     * @param null $perPage
     * @return mixed
     */
    public function StatisticsByTheNumberOfDays($subDays = null)
    {
        $getAll = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->orderBy('date', 'desc')
            ->paginate();

        $AverageCorRate = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('canceled_orders_rate')
            ->avg('canceled_orders_rate');

        $AverageRorRate = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('returned_orders_ratio')
            ->avg('returned_orders_ratio');

        $AverageRprRate = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('received_parcel_ratio')
            ->avg('received_parcel_ratio');

        $AverageClientCostRate = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('client_cost')
            ->avg('client_cost');

        $SumProfit = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('profit')
            ->sum('profit');

        $AverageApplicationPrice = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('application_price')
            ->avg('application_price');

        $SumTargetCosts = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('advertising')
            ->sum('advertising');

        $AverageMarginality = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('marginality')
            ->avg('marginality');

        $SumInvestorProfit = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('investor_profit')
            ->sum('investor_profit');

        $SumManagerSalary = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('manager_salary')
            ->sum('manager_salary');

        $SumApplications = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('applications')
            ->sum('applications');

        $SumAtThePostOffice = $this
            ->startConditions()
            ->whereDate('date', '>=', Carbon::today()->subDays($subDays)->format('Y-m-d'))
            ->select('at_the_post_office')
            ->sum('at_the_post_office');

        return [
            $getAll,
            $AverageCorRate,
            $AverageRorRate,
            $AverageRprRate,
            $AverageClientCostRate,
            $SumProfit,
            $AverageApplicationPrice,
            $SumTargetCosts,
            $AverageMarginality,
            $SumInvestorProfit,
            $SumManagerSalary,
            $SumApplications,
            $SumAtThePostOffice
        ];
    }

    public function StatisticsByDateRange($request)
    {
        $range = explode(' - ', $request->date_range);

        if (isset($range[1])) {
            $result = $this->startConditions()->whereBetween('date', [$range[0], $range[1]])->paginate(15);

            $AverageCorRate = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('canceled_orders_rate')
                ->avg('canceled_orders_rate');

            $AverageRorRate = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('returned_orders_ratio')
                ->avg('returned_orders_ratio');

            $AverageRprRate = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('received_parcel_ratio')
                ->avg('received_parcel_ratio');

            $AverageClientCostRate = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('client_cost')
                ->avg('client_cost');

            $SumProfit = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('profit')
                ->sum('profit');

            $AverageApplicationPrice = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('application_price')
                ->avg('application_price');

            $SumTargetCosts = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('advertising')
                ->sum('advertising');

            $AverageMarginality = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('marginality')
                ->avg('marginality');

            $SumInvestorProfit = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('investor_profit')
                ->sum('investor_profit');

            $SumManagerSalary = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('manager_salary')
                ->sum('manager_salary');

            $SumApplications = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('applications')
                ->sum('applications');

            $SumAtThePostOffice = $this
                ->startConditions()
                ->whereBetween('date', [$range[0], $range[1]])
                ->select('at_the_post_office')
                ->sum('at_the_post_office');

        } else {
            $result = $this->startConditions()->whereDate('date', $range[0])->paginate();

            $AverageCorRate = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('canceled_orders_rate')
                ->avg('canceled_orders_rate');

            $AverageRorRate = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('returned_orders_ratio')
                ->avg('returned_orders_ratio');

            $AverageRprRate = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('received_parcel_ratio')
                ->avg('received_parcel_ratio');

            $AverageClientCostRate = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('client_cost')
                ->avg('client_cost');

            $SumProfit = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('profit')
                ->sum('profit');

            $AverageApplicationPrice = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('application_price')
                ->avg('application_price');

            $SumTargetCosts = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('advertising')
                ->sum('advertising');

            $AverageMarginality = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('marginality')
                ->avg('marginality');

            $SumInvestorProfit = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('investor_profit')
                ->sum('investor_profit');

            $SumManagerSalary = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('manager_salary')
                ->sum('manager_salary');

            $SumApplications = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('applications')
                ->sum('applications');

            $SumAtThePostOffice = $this
                ->startConditions()
                ->whereDate('date', $range[0])
                ->select('at_the_post_office')
                ->sum('at_the_post_office');
        }


        return [
            $result,
            $AverageCorRate,
            $AverageRorRate,
            $AverageRprRate,
            $AverageClientCostRate,
            $SumProfit,
            $AverageApplicationPrice,
            $SumTargetCosts,
            $AverageMarginality,
            $SumInvestorProfit,
            $SumManagerSalary,
            $SumApplications,
            $SumAtThePostOffice,
        ];
    }

    /**
     * Вывести выполненные заказы в пагинацию по 15 шт.
     *
     * @param null $perPage
     * @return mixed
     */
    public function getDoneOrdersWithPaginate($perPage = null)
    {
        $doneOrders = Orders::where('status', 'Выполнен')
            ->select([
                'id',
                'name',
                'trade_price',
                'sale_price',
                'product_id',
                'pay',
                'profit',
                'created_at',
                'updated_at'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return $doneOrders;
    }

}
