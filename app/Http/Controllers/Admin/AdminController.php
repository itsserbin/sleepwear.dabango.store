<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\OrdersDay;
use App\Models\Bookkeeping\Profit;
use App\Models\Clients;
use App\Models\Orders;
use App\Repositories\OrdersRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    private $OrdersRepository;

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->OrdersRepository = app(OrdersRepository::class);
    }

    public function index()
    {

        $days_orders = OrdersDay::orderBy('date', 'desc')->paginate(15);

        $orders = $this->OrdersRepository->getAllWithPaginate(10);
//        $orders = Orders::orderBy('created_at','desc')->with('Clients')->paginate(10);
        $orders_today = Orders::whereDate('created_at', Carbon::now()->format('Y-m-d'))->count();
        $clients = Clients::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.dashboard', [
            'orders' => $orders,
            'orders_today' => $orders_today,
            'clients' => $clients,
            'days_orders' => $days_orders
        ]);
    }
}
