<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\OrdersDay;
use App\Models\Orders;
use App\Repositories\Bookkeeping\BookkeepingRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function index()
    {
        $days_orders = OrdersDay::orderBy('date', 'desc')->paginate(15);

        return view('admin.bookkeeping.daily-statistics.index', [
            'days_orders' => $days_orders
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

    public function ShowStatisticsForTheWeek()
    {
       $days_orders = $this->OrdersDaysRepository->ShowStatisticsForTheWeek();
        dd($days_orders);
//        dd(Carbon::today()->subDays(7)->format('Y-m-d'));
//        return view('admin.bookkeeping.daily-statistics.index', [
//            'days_orders' => $days_orders
//        ]);
    }
}
