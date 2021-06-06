<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\OrdersDay;
use App\Models\Orders;
use App\Repositories\Bookkeeping\BookkeepingRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class DailyStatisticsController
 * @package App\Http\Controllers\Bookkeeping
 */
class DailyStatisticsController extends Controller
{
    private $BookkeepingRepository;

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->BookkeepingRepository = app(BookkeepingRepository::class);
    }

    /**
     * Показать статистику за все время.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = $this->BookkeepingRepository->ShowAllStatistics(15);

        return view('admin.bookkeeping.daily-statistics.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $orders_day = new OrdersDay();

        return view('admin.bookkeeping.daily-statistics.create', [
            'orders_day' => $orders_day
        ]);
    }

    public function store(Request $request)
    {
        $orders_day = new OrdersDay();
        $orders_day->date = $request->input('date');
        $orders_day->save();

        return redirect(route('admin.bookkeeping.daily-statistics.index'));
    }

    public function destroy($id)
    {
        OrdersDay::destroy($id);

        return back();
    }

    /**
     * Показать статистику за 7 дней.
     *
     * @return Application|Factory|View
     */
    public function showStatisticsFor7Days()
    {
       $days_orders = $this->BookkeepingRepository->StatisticsByTheNumberOfDays(7);

        $data = $days_orders[0];
        $AverageCorRate = $days_orders[1];
        $AverageRorRate = $days_orders[2];
        $AverageRprRate = $days_orders[3];
        $AverageClientCostRate = $days_orders[4];
        $SumProfit = $days_orders[5];
        $AverageApplicationPrice = $days_orders[6];
        $SumTargetCosts = $days_orders[7];
        $AverageMarginality = $days_orders[8];
        $SumInvestorProfit = $days_orders[9];
        $SumManagerSalary = $days_orders[10];
        $AverageApplications = $days_orders[11];
        $SumAtThePostOffice = $days_orders[12];

        return view('admin.bookkeeping.daily-statistics.index', [
            'data' => $data,
            'AverageCorRate' => $AverageCorRate,
            'AverageRorRate' => $AverageRorRate,
            'AverageRprRate' => $AverageRprRate,
            'AverageClientCostRate' => $AverageClientCostRate,
            'SumProfit' => $SumProfit,
            'AverageApplicationPrice' => $AverageApplicationPrice,
            'SumTargetCosts' => $SumTargetCosts,
            'AverageMarginality' => $AverageMarginality,
            'SumInvestorProfit' => $SumInvestorProfit,
            'SumManagerSalary' => $SumManagerSalary,
            'AverageApplications' => $AverageApplications,
            'SumAtThePostOffice' => $SumAtThePostOffice,
        ]);
    }

    /**
     * Показать статистику за 14 дней.
     *
     * @return Application|Factory|View
     */
    public function showStatisticsFor14Days()
    {
        $days_orders = $this->BookkeepingRepository->StatisticsByTheNumberOfDays(14);

        $data = $days_orders[0];
        $AverageCorRate = $days_orders[1];
        $AverageRorRate = $days_orders[2];
        $AverageRprRate = $days_orders[3];
        $AverageClientCostRate = $days_orders[4];
        $SumProfit = $days_orders[5];
        $AverageApplicationPrice = $days_orders[6];
        $SumTargetCosts = $days_orders[7];
        $AverageMarginality = $days_orders[8];
        $SumInvestorProfit = $days_orders[9];
        $SumManagerSalary = $days_orders[10];
        $AverageApplications = $days_orders[11];
        $SumAtThePostOffice = $days_orders[12];

        return view('admin.bookkeeping.daily-statistics.index', [
            'data' => $data,
            'AverageCorRate' => $AverageCorRate,
            'AverageRorRate' => $AverageRorRate,
            'AverageRprRate' => $AverageRprRate,
            'AverageClientCostRate' => $AverageClientCostRate,
            'SumProfit' => $SumProfit,
            'AverageApplicationPrice' => $AverageApplicationPrice,
            'SumTargetCosts' => $SumTargetCosts,
            'AverageMarginality' => $AverageMarginality,
            'SumInvestorProfit' => $SumInvestorProfit,
            'SumManagerSalary' => $SumManagerSalary,
            'AverageApplications' => $AverageApplications,
            'SumAtThePostOffice' => $SumAtThePostOffice,
        ]);
    }

    /**
     * Показать статистику за 30 дней.
     *
     * @return Application|Factory|View
     */
    public function showStatisticsFor30Days()
    {
        $days_orders = $this->BookkeepingRepository->StatisticsByTheNumberOfDays(30);

        $data = $days_orders[0];
        $AverageCorRate = $days_orders[1];
        $AverageRorRate = $days_orders[2];
        $AverageRprRate = $days_orders[3];
        $AverageClientCostRate = $days_orders[4];
        $SumProfit = $days_orders[5];
        $AverageApplicationPrice = $days_orders[6];
        $SumTargetCosts = $days_orders[7];
        $AverageMarginality = $days_orders[8];
        $SumInvestorProfit = $days_orders[9];
        $SumManagerSalary = $days_orders[10];
        $AverageApplications = $days_orders[11];
        $SumAtThePostOffice = $days_orders[12];

        return view('admin.bookkeeping.daily-statistics.index', [
            'data' => $data,
            'AverageCorRate' => $AverageCorRate,
            'AverageRorRate' => $AverageRorRate,
            'AverageRprRate' => $AverageRprRate,
            'AverageClientCostRate' => $AverageClientCostRate,
            'SumProfit' => $SumProfit,
            'AverageApplicationPrice' => $AverageApplicationPrice,
            'SumTargetCosts' => $SumTargetCosts,
            'AverageMarginality' => $AverageMarginality,
            'SumInvestorProfit' => $SumInvestorProfit,
            'SumManagerSalary' => $SumManagerSalary,
            'AverageApplications' => $AverageApplications,
            'SumAtThePostOffice' => $SumAtThePostOffice,
        ]);
    }
}
