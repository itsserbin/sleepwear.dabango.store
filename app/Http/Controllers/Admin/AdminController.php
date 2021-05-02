<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Profit;
use App\Models\Clients;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Orders::orderBy('created_at','desc')->paginate(10);
        $orders_today = Orders::whereDate('created_at',Carbon::now()->format('Y-m-d'))->count();
        $clients = Clients::orderBy('updated_at','desc')->paginate(10);

        return view('admin.dashboard',[
            'orders' => $orders,
            'orders_today' => $orders_today,
            'clients' => $clients,
        ]);
    }
}
