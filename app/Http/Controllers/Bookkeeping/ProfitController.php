<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Profit;
use App\Models\Clients;
use App\Models\Orders;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function index()
    {
        $profitOrders = Orders::where('status', 'Выполнен')->paginate(15);
//        dd($profitOrders);
        $ProfitOrdersInJustAWeek = Orders::where('status', 'done')
            ->orderBy('created_at', 'desc')
            ->select('trade_price','sale_price')
            ->get(7);

        $profits = Profit::paginate(15);
        $ProfitInJustAWeek = Profit::orderBy('created_at', 'desc')
            ->select('marginality')
            ->get(7)
            ->sum('marginality');

        return view('admin.bookkeeping.profit.index', [
            'profitOrders' => $profitOrders,
            'ProfitOrdersInJustAWeek' => $ProfitOrdersInJustAWeek,

            'profits' => $profits,
            'ProfitInJustAWeek' => $ProfitInJustAWeek
        ]);
    }

    public function create()
    {

    }
}
