<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\Profit;
use App\Models\Clients;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function index()
    {

        $profitOrders = Orders::where('status', 'Выполнен')->paginate(15);

        $SaleSumInJustAThreeDays =
            Orders::whereDate('orders.created_at', '>=', Carbon::today()->subDays(3))
                ->where('status', 'Выполнен')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->select([
                    'orders.id',
                    'order_items.order_id',
                    'order_items.sale_price',
                ])
                ->sum('order_items.sale_price');

        $TradeSumInJustAThreeDays =
            Orders::whereDate('orders.created_at', '>=', Carbon::today()->subDays(3))
                ->where('status', 'Выполнен')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->select([
                    'orders.id',
                    'order_items.order_id',
                    'order_items.trade_price',
                ])
                ->sum('order_items.trade_price');


        $ProfitOrdersInJustAThreeDays = $SaleSumInJustAThreeDays - $TradeSumInJustAThreeDays;

        $SaleSumInJustAWeek =
            Orders::whereDate('orders.created_at', '>=', Carbon::today()->subDays(7))
                ->where('status', 'Выполнен')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->select([
                    'orders.id',
                    'order_items.order_id',
                    'order_items.sale_price',
                ])
                ->sum('order_items.sale_price');

        $TradeSumInJustAWeek =
            Orders::whereDate('orders.created_at', '>=', Carbon::today()->subDays(7))
                ->where('status', 'Выполнен')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->select([
                    'orders.id',
                    'order_items.order_id',
                    'order_items.trade_price',
                ])
                ->sum('order_items.trade_price');

        $ProfitOrdersInJustAWeek = $SaleSumInJustAWeek - $TradeSumInJustAWeek;

        $SaleSumInJustAMonth =
            Orders::whereDate('orders.created_at', '>=', Carbon::today()->subDays(7))
                ->where('status', 'Выполнен')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->select([
                    'orders.id',
                    'order_items.order_id',
                    'order_items.sale_price',
                ])
                ->sum('order_items.sale_price');

        $TradeSumInJustAMonth =
            Orders::whereDate('orders.created_at', '>=', Carbon::today()->subDays(7))
                ->where('status', 'Выполнен')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->select([
                    'orders.id',
                    'order_items.order_id',
                    'order_items.trade_price',
                ])
                ->sum('order_items.trade_price');


        $ProfitOrdersInJustAMonth = $SaleSumInJustAMonth - $TradeSumInJustAMonth;

        $profits = Profit::orderBy('created_at', 'desc')->paginate(15);

        $ProfitInJustAThreeDays =
            Profit::whereDate('created_at', '>=', Carbon::today()->subDays(3))
                ->select('marginality')
                ->sum('marginality');

        $ProfitInJustAWeek = Profit::whereDate('created_at', '>=', Carbon::today()->subDays(7))
            ->select('marginality')
            ->sum('marginality');

        $ProfitInJustAMonth = Profit::whereMonth('created_at', Carbon::now()->format('m'))
            ->select('marginality')
            ->get()
            ->sum('marginality');

        return view('admin.bookkeeping.profit.index', [
            'profitOrders' => $profitOrders,
            'ProfitOrdersInJustAWeek' => $ProfitOrdersInJustAWeek,
            'ProfitOrdersInJustAMonth' => $ProfitOrdersInJustAMonth,
            'ProfitOrdersInJustAThreeDays' => $ProfitOrdersInJustAThreeDays,

            'profits' => $profits,
            'ProfitInJustAWeek' => $ProfitInJustAWeek,
            'ProfitInJustAMonth' => $ProfitInJustAMonth,
            'ProfitInJustAThreeDays' => $ProfitInJustAThreeDays
        ]);
    }

    public function create()
    {
        $profit = new Profit();

        return view('admin.bookkeeping.profit.create', [
            'profit' => $profit,
        ]);
    }

    public function store(Request $request)
    {
        $profit = new Profit();
        $profit->date = $request->input('date');
        $profit->save();

        return redirect(route('admin.bookkeeping.profit.index'));
    }
}
