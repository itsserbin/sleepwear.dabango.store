<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\Profit;
use App\Models\Clients;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $date_now = Carbon::now()->format('Y-m-d');
        $profit_now = Profit::whereDate('created_at',$date_now)->get();
        $profit_old = Profit::all();

        foreach ($profit_old as $item){
            $created_at = $item->date->format('Y-m-d');
            $item->profit = $ProfitProfit = Orders::whereDate('created_at',$created_at)
                ->where('status','Выполнен')
                ->select('profit')
                ->sum('profit');

            $item->cost = $ProfitCost = Costs::whereDate('date', $created_at)
                ->select('total')
                ->sum('total');
            $item->marginality = $ProfitProfit - $ProfitCost;
            $item->turnover = $ProfitProfit + $ProfitCost;
            $item->update();
        }

        if (count($profit_now)){
            foreach ($profit_now as $item){
                $item->profit = $ProfitProfit = Orders::whereDate('created_at', $date_now)
                    ->where('status', 'Выполнен')
                    ->select('profit')
                    ->sum('profit');

                $item->cost = $ProfitCost = Costs::whereDate('date', $date_now)
                    ->select('total')
                    ->sum('total');
                $item->marginality = $ProfitProfit - $ProfitCost;
                $item->turnover = $ProfitProfit + $ProfitCost;
                $item->update();
            }
        }else{
            $profit = new Profit();
            $profit->date = $date_now;
            $profit->cost = $ProfitCost = Costs::whereDate('date', $date_now)
                ->select('total')
                ->sum('total');

            $profit->profit = $ProfitProfit = Orders::whereDate('created_at', $date_now)
                ->where('status', 'Выполнен')
                ->select('profit')
                ->sum('profit');

            $profit->marginality = $ProfitProfit - $ProfitCost;
            $profit->turnover = $ProfitProfit + $ProfitCost;
            $profit->save();;
        }


        $orders = Orders::orderBy('created_at','desc')->paginate(15);

        return view('admin.orders.index',[
            'orders' => $orders
        ]);
    }

    public function edit($id)
    {
        $order = Orders::find($id);

        return view('admin.orders.edit',[
            'order' => $order
        ]);
    }

    public function update($id, Request $request)
    {
        $order = Orders::find($id);
        $data = $request->all();
        $order->update($data);

        return view('admin.orders.edit',[
            'order' => $order
        ])->with('success','Заказ успешно обновлен');
    }

    public function destroy($id)
    {
        $order = Orders::destroy($id);
        return back();
    }

    public function showNewOrders()
    {
        $orders = Orders::where('status', 'Новый')->paginate(15);

        return view('admin.orders.new.index', [
            'orders' => $orders,
        ]);
    }

    public function showProcessOrders()
    {
        $orders = Orders::where('status', 'В процессе')->paginate(15);

        return view('admin.orders.process.index', [
            'orders' => $orders,
        ]);
    }

    public function showTransferredToSupplierOrders()
    {
        $orders = Orders::where('status', 'Передан поставщику')->paginate(15);

        return view('admin.orders.transferred-to-supplier.index', [
            'orders' => $orders,
        ]);
    }

    public function showPostOfficeOrders()
    {
        $orders = Orders::where('status', 'На почте')->paginate(15);

        return view('admin.orders.post-office-clients.index', [
            'orders' => $orders,
        ]);
    }

    public function showDoneOrders()
    {
        $orders = Orders::where('status', 'Выполнен')->paginate(15);

        return view('admin.orders.done.index', [
            'orders' => $orders,
        ]);
    }

    public function showReturnOrders()
    {
        $orders = Orders::where('status', 'Возврат')->paginate(15);

        return view('admin.orders.return.index', [
            'orders' => $orders,
        ]);
    }


    public function showCancelOrders()
    {
        $orders = Orders::where('status', 'Отменен')->paginate(15);

        return view('admin.orders.cancel.index', [
            'orders' => $orders,
        ]);
    }

}
