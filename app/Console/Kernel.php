<?php

namespace App\Console;

use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\OrdersDay;
use App\Models\Bookkeeping\Profit;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\Enum\OrderStatus;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $date_now = Carbon::now()->format('Y-m-d');

            $profit_now = Profit::whereDate('date', $date_now)->get();

            $profit_old = Profit::all();

            foreach ($profit_old as $item) {
                $created_at = $item->date->format('Y-m-d');

                $item->profit = $ProfitProfit = DB::table('orders')
                    ->whereDate('orders.created_at', $created_at)
                    ->where('status', OrderStatus::STATUS_DONE)
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->select([
                        'orders.id',
                        'order_items.order_id',
                        'order_items.profit',
                    ])
                    ->sum('order_items.profit');

                $item->cost = $ProfitCost = Costs::whereDate('date', $created_at)
                    ->select('total')
                    ->sum('total');

                $item->marginality = $ProfitProfit - $ProfitCost;

                $item->turnover = $ProfitProfit + $ProfitCost;

                $item->update();
            }

            if (count($profit_now)) {
                foreach ($profit_now as $item) {

                    $item->profit = $ProfitProfit =
                        DB::table('orders')
                            ->whereDate('orders.created_at', $date_now)
                            ->where('status', OrderStatus::STATUS_DONE)
                            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                            ->select([
                                'orders.id',
                                'order_items.order_id',
                                'order_items.profit',
                            ])
                            ->sum('order_items.profit');

                    $item->cost = $ProfitCost = Costs::whereDate('date', $date_now)
                        ->select('total')
                        ->sum('total');

                    $item->marginality = $ProfitProfit - $ProfitCost;
                    $item->turnover = $ProfitProfit + $ProfitCost;
                    $item->update();
                }
            } else {
                $profit = new Profit();
                $profit->date = $date_now;
                $profit->cost = $ProfitCost = Costs::whereDate('date', $date_now)
                    ->select('total')
                    ->sum('total');

                $profit->profit = $ProfitProfit = DB::table('orders')
                    ->whereDate('orders.created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_DONE)
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->select([
                        'orders.id',
                        'order_items.order_id',
                        'order_items.profit',
                    ])
                    ->sum('order_items.profit');

                $profit->marginality = $ProfitProfit - $ProfitCost;
                $profit->turnover = $ProfitProfit + $ProfitCost;
                $profit->save();;
            }

        })->everyMinute();

        /**
         * Интеграция API с НоваПошта
         *
         * Обновление раз в 5 минут.
         */
        $schedule->call(function () {
            $orders = Orders::where([
                ['waybill', '!=', null],
                ['status', '!=', OrderStatus::STATUS_DONE],
                ['status', '!=', OrderStatus::STATUS_AWAITING_PREPAYMENT],
            ])->select('id', 'status', 'waybill')->get();

            foreach ($orders as $item) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.novaposhta.ua/v2.0/json/",
                    CURLOPT_RETURNTRANSFER => True,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode([
                        'apiKey' => 'ef9ad9f085a4555623f1513fd91a5892',
                        'modelName' => 'TrackingDocument',
                        'calledMethod' => 'getStatusDocuments',
                        'methodProperties' => [
                            'Documents' => [
                                ['DocumentNumber' => $item->waybill],
                            ]
                        ]
                    ]),
                    CURLOPT_HTTPHEADER => array("content-type: application/json",),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $result = json_decode($response, true);

                    if ((int)$result['data'][0]['StatusCode'] === 1) {
                        $item->status = OrderStatus::STATUS_AWAITING_DISPATCH;
                    } elseif (in_array((int)$result['data'][0]['StatusCode'], [102, 103, 108], true)) {
                        $item->status = OrderStatus::STATUS_RETURN;
                    } elseif (in_array((int)$result['data'][0]['StatusCode'], [7, 8], true)) {
                        $item->status = OrderStatus::STATUS_AT_THE_POST_OFFICE;
                    } elseif (in_array((int)$result['data'][0]['StatusCode'], [5, 6, 101], true)) {
                        $item->status = OrderStatus::STATUS_ON_THE_ROAD;
                    } elseif (in_array((int)$result['data'][0]['StatusCode'], [9, 10, 11], true)) {
                        $item->status = OrderStatus::STATUS_DONE;
                    }
                    $item->update();
                }
            }

        })->everyMinute();

        /**
         * Подсчет дневной статистики.
         *
         * Обновление каждую минуту.
         */
        $schedule->call(function () {
            $date_now = Carbon::now()->format('Y-m-d');

            $orders_old = OrdersDay::all();
            $orders_days = OrdersDay::whereDate('date', $date_now)->first();

            $OrdersCountNow = Orders::whereDate('created_at', $date_now)
                ->count();

            $DoneOrdersCountNow = Orders::whereDate('created_at', $date_now)
                ->where('status', OrderStatus::STATUS_DONE)
                ->count();

            $CancelOrdersCountNow = Orders::whereDate('created_at', $date_now)
                ->where('status', OrderStatus::STATUS_CANCELED)
                ->count();

            $SumCostsNow = Costs::whereDate('date', $date_now)
                ->where('name', 'Таргет')
                ->select('total')
                ->sum('total');

            $SumDayProfitNow = Profit::whereDate('created_at', $date_now)
                ->select('profit')
                ->sum('profit');

            $SumDayMarginalityNow = Profit::whereDate('date', $date_now)
                ->select('marginality')
                ->sum('marginality');

            $SumDayCostsNow = Profit::whereDate('created_at', $date_now)
                ->select('cost')
                ->sum('cost');

            $ReturnOrdersCountNow = Orders::whereDate('created_at', $date_now)
                ->where('status', OrderStatus::STATUS_RETURN)
                ->count();

            if ($orders_days == null) {
                $orders_days = new OrdersDay();
                $orders_days->date = $date_now;

                $orders_days->advertising = Costs::whereDate('date', $date_now)
                    ->where('name', 'Таргет')
                    ->select('total')
                    ->sum('total');

                $orders_days->applications = Orders::whereDate('created_at', $date_now)
                    ->count();

                if ($orders_days->applications > 0) {
                    $orders_days->application_price = $orders_days->advertising / $orders_days->applications;
                } else {
                    $orders_days->application_price = '-';
                }

                $orders_days->in_process = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_PROCESSED)
                    ->count();

                $orders_days->transferred_to_supplier = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_TRANSFERRED_TO_SUPPLIER)
                    ->count();

                $orders_days->unprocessed = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_NEW)
                    ->count();

                $orders_days->at_the_post_office = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_AT_THE_POST_OFFICE)
                    ->count();

                $orders_days->completed_applications = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_DONE)
                    ->count();

                $orders_days->refunds = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_RETURN)
                    ->count();

                $orders_days->cancel = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_CANCELED)
                    ->count();

                $orders_days->awaiting_dispatch = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_AWAITING_DISPATCH)
                    ->count();

                $orders_days->awaiting_prepayment = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_AWAITING_PREPAYMENT)
                    ->count();

                $orders_days->on_the_road = Orders::whereDate('created_at', $date_now)
                    ->where('status', OrderStatus::STATUS_ON_THE_ROAD)
                    ->count();

                if ($OrdersCountNow !== 0) {
                    $orders_days->canceled_orders_rate = $CancelOrdersCountNow / $OrdersCountNow;
                    $orders_days->returned_orders_ratio = $ReturnOrdersCountNow / $OrdersCountNow;
                    $orders_days->received_parcel_ratio = $DoneOrdersCountNow / $OrdersCountNow;
                }

                $orders_days->manager_salary = ($DoneOrdersCountNow + $ReturnOrdersCountNow) * 15;

                $orders_days->costs = $SumCostsNow + $orders_days->manager_salary + (100 * $ReturnOrdersCountNow);

                $orders_days->profit = $SumDayProfitNow;

                $orders_days->net_profit = $orders_days->profit - $orders_days->costs;

                if ($DoneOrdersCountNow !== 0) {
                    $orders_days->client_cost = $orders_days->net_profit / $DoneOrdersCountNow;
                }

                if ($SumDayCostsNow !== 0) {
                    $orders_days->marginality = $orders_days->profit / $orders_days->costs;
                }

                $orders_days->investor_profit = $SumCostsNow * 0.05;

                $orders_days->save();
            } else {
                foreach ($orders_old as $item) {
                    $date = $item->date->format('Y-m-d');

                    $OrdersCount = Orders::whereDate('created_at', $date)
                        ->count();

                    $DoneOrdersCount = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_DONE)
                        ->count();

                    $CancelOrdersCount = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_CANCELED)
                        ->count();

                    $SumCosts = Costs::whereDate('date', $date)
                        ->where('name', 'Таргет')
                        ->select('total')
                        ->sum('total');

                    $SumDayProfit = Profit::whereDate('created_at', $date)
                        ->select('profit')
                        ->sum('profit');

                    $SumDayCosts = Profit::whereDate('created_at', $date)
                        ->select('cost')
                        ->sum('cost');

                    $ReturnOrdersCount = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_RETURN)
                        ->count();

                    $item->advertising = Costs::whereDate('date', $date)
                        ->where('name', 'Таргет')
                        ->select('total')
                        ->sum('total');

                    $item->applications = Orders::whereDate('created_at', $date)
                        ->count();

                    if ($item->applications > 0) {
                        $item->application_price = $item->advertising / $item->applications;
                    } else {
                        $item->application_price = '-';
                    }

                    $item->in_process = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_PROCESSED)
                        ->count();

                    $item->transferred_to_supplier = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_TRANSFERRED_TO_SUPPLIER)
                        ->count();

                    $item->at_the_post_office = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_AT_THE_POST_OFFICE)
                        ->count();

                    $item->completed_applications = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_DONE)
                        ->count();

                    $item->unprocessed = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_NEW)
                        ->count();

                    $item->refunds = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_RETURN)
                        ->count();

                    $item->cancel = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_CANCELED)
                        ->count();

                    $item->awaiting_dispatch = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_AWAITING_DISPATCH)
                        ->count();

                    $item->awaiting_prepayment = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_AWAITING_PREPAYMENT)
                        ->count();

                    $item->on_the_road = Orders::whereDate('created_at', $date)
                        ->where('status', OrderStatus::STATUS_ON_THE_ROAD)
                        ->count();

                    if ($OrdersCount !== 0) {
                        $item->canceled_orders_rate = $CancelOrdersCount / $OrdersCount;
                        $item->returned_orders_ratio = $ReturnOrdersCount / $OrdersCount;
                        $item->received_parcel_ratio = $DoneOrdersCount / $OrdersCount;
                    }

                    $item->manager_salary = ($DoneOrdersCount + $ReturnOrdersCount) * 15;

                    $item->profit = $SumDayProfit;

                    $item->costs = $SumCosts + $item->manager_salary + (100 * $ReturnOrdersCount);

                    $item->net_profit = ($item->profit) - ($item->costs);

                    if ($DoneOrdersCount !== 0) {
                        $item->client_cost = $item->net_profit / $DoneOrdersCount;
                    }

                    if ($SumDayCosts !== 0) {
                        $item->marginality = $item->profit / $item->costs;
                    }

                    $item->investor_profit = $SumCosts * 0.05;

                    $item->update();
                }
            }

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected
    function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
