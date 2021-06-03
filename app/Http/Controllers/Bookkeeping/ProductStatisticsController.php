<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Repositories\Bookkeeping\BookkeepingRepository;
use Illuminate\Http\Request;

class ProductStatisticsController extends Controller
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

    public function index()
    {
        $done_orders = $this->BookkeepingRepository->getDoneOrdersWithPaginate(15);

        return view('admin.bookkeeping.product-statistics.index', [
            'done_orders' => $done_orders,
        ]);
    }
}
