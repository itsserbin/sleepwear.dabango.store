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

        $SaleSumInJustAThreeDays = Orders::where('status', 'Выполнен')
            ->orderBy('created_at', 'desc')
            ->select('sale_price')
            ->get(3)
            ->sum('sale_price');

        $TradeSumInJustAThreeDays = Orders::where('status', 'Выполнен')
            ->orderBy('created_at', 'desc')
            ->select('trade_price')
            ->get(3)
            ->sum('trade_price');
        $ProfitOrdersInJustAThreeDays = $SaleSumInJustAThreeDays - $TradeSumInJustAThreeDays;

        $SaleSumInJustAWeek = Orders::where('status', 'Выполнен')
            ->orderBy('created_at', 'desc')
            ->select('sale_price')
            ->get(7)
            ->sum('sale_price');

        $TradeSumInJustAWeek = Orders::where('status', 'Выполнен')
            ->orderBy('created_at', 'desc')
            ->select('trade_price')
            ->get(7)
            ->sum('trade_price');
        $ProfitOrdersInJustAWeek = $SaleSumInJustAWeek - $TradeSumInJustAWeek;

        $SaleSumInJustAMonth = Orders::whereMonth('created_at', Carbon::now()->format('m'))
            ->where('status', 'Выполнен')
            ->select('sale_price')
            ->get()
            ->sum('sale_price');

        $TradeSumInJustAMonth = Orders::whereMonth('created_at', Carbon::now()->format('m'))
            ->where('status', 'Выполнен')
            ->select('trade_price')
            ->get()
            ->sum('trade_price');
        $ProfitOrdersInJustAMonth = $SaleSumInJustAMonth - $TradeSumInJustAMonth;

        $profits = Profit::paginate(15);

        $ProfitInJustAThreeDays = Profit::orderBy('created_at', 'desc')
            ->select('marginality')
            ->get(3)
            ->sum('marginality');

        $ProfitInJustAWeek = Profit::orderBy('created_at', 'desc')
            ->select('marginality')
            ->get(7)
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

        return view('admin.bookkeeping.profit.create',[
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
