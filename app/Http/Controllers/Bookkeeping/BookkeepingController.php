<?php

namespace App\Http\Controllers\Bookkeeping;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\Profit;
use App\Models\Clients;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookkeepingController extends Controller
{
    public function index()
    {
        $costs = Costs::orderBy('created_at', 'DESC')->paginate(15);
        $CostsInJustAWeek = Costs::orderBy('created_at', 'desc')
            ->select('total')
            ->get(7)
            ->sum('total');

        $orders = Orders::where('status', 'Выполнен')
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'product_id', 'phone', 'trade_price', 'sale_price', 'updated_at')
            ->paginate(15);

        $OrdersProfitInJustAWeek = Orders::where('status', 'Выполнен')
            ->orderBy('created_at', 'desc')
            ->select('trade_price', 'sale_price')
            ->get(7)
            ->sum('profit');

        $profits = Profit::paginate(15);
        $ProfitInJustAWeek = Profit::orderBy('created_at', 'desc')
            ->select('marginality')
            ->get(7)
            ->sum('marginality');

        return view('admin.bookkeeping.index', [
            'costs' => $costs,
            'CostsInJustAWeek' => $CostsInJustAWeek,

            'orders' => $orders,
            'OrdersProfitInJustAWeek' => $OrdersProfitInJustAWeek,

            'profits' => $profits,
            'ProfitInJustAWeek' => $ProfitInJustAWeek
        ]);
    }
}
