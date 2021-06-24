<?php

namespace App\Http\Controllers\Api\Bookkeeping;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\Bookkeeping\BookkeepingRepository;
use Illuminate\Http\Request;

/**
 * Class DailyStatisticsController
 * @package App\Http\Controllers\Api\Bookkeeping
 */
class DailyStatisticsController extends BaseController
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
     * Оборажение всей статистики.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
//        $result = $this->BookkeepingRepository->getAllWithPaginate(15);

        if ($request->has('days')) {
            $result = $this->BookkeepingRepository->StatisticsByTheNumberOfDays($request->get('days'), 15);
        } else {
            $result = $this->BookkeepingRepository->getAllWithPaginate(15);
        }

        return $this->returnResponse([
            'success' => true,
            'result' => $result[0],
            'AverageCorRate' => $result[1],
            'AverageRorRate' => $result[2],
            'AverageRprRate' => $result[3],
            'AverageClientCostRate' => $result[4],
            'SumProfit' => $result[5],
            'AverageApplicationPrice' => $result[6],
            'SumTargetCosts' => $result[7],
            'AverageMarginality' => $result[8],
            'SumInvestorProfit' => $result[9],
            'SumManagerSalary' => $result[10],
            'SumApplications' => $result[11],
            'SumAtThePostOffice' => $result[12],
        ]);
    }

    /**
     * Получение статистики за последние {search} дни.
     *
     * @param $search
     */
    public function showStatisticsForDays($search)
    {
        $result = $this->BookkeepingRepository->StatisticsByTheNumberOfDays($search);

        return $this->returnResponse([
            'success' => true,
            'result' => $result,
        ]);
    }

    public function dateRange(Request $request)
    {
        $result = $this->BookkeepingRepository->StatisticsByDateRange($request->all());

        return $this->returnResponse([
            'success' => true,
            'result' => $result[0],
            'AverageCorRate' => $result[1],
            'AverageRorRate' => $result[2],
            'AverageRprRate' => $result[3],
            'AverageClientCostRate' => $result[4],
            'SumProfit' => $result[5],
            'AverageApplicationPrice' => $result[6],
            'SumTargetCosts' => $result[7],
            'AverageMarginality' => $result[8],
            'SumInvestorProfit' => $result[9],
            'SumManagerSalary' => $result[10],
            'SumApplications' => $result[11],
            'SumAtThePostOffice' => $result[12],
        ]);
    }
}
