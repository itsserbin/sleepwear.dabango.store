<?php

namespace App\Console;

use App\Models\Bookkeeping\Costs;
use App\Models\Bookkeeping\OrdersDay;
use App\Models\Bookkeeping\Profit;
use App\Models\BookkeepingCosts;
use App\Models\Clients;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
            $profit_now = Profit::whereDate('date',$date_now)->get();
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

        })->everyMinute();

        $schedule->call(function () {
            $date_now = Carbon::now()->format('Y-m-d');

            $orders_old = OrdersDay::all();
            $orders_days = OrdersDay::whereDate('date', $date_now)->first();

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
                }else{
                    $orders_days->application_price = '-';
                }

                $orders_days->in_process = Orders::whereDate('created_at', $date_now)
                    ->where('status', 'В процессе')
                    ->count();

                $orders_days->transferred_to_supplier = Orders::whereDate('created_at', $date_now)
                    ->where('status', 'Передан поставщику')
                    ->count();

                $orders_days->unprocessed = Orders::whereDate('created_at', $date_now)
                    ->where('status', 'Новый')
                    ->count();

                $orders_days->at_the_post_office = Orders::whereDate('created_at', $date_now)
                    ->where('status', 'На почте')
                    ->count();

                $orders_days->completed_applications = Orders::whereDate('created_at', $date_now)
                    ->where('status', 'Выполнен')
                    ->count();

                $orders_days->refunds = Orders::whereDate('created_at', $date_now)
                    ->where('status', 'Возврат')
                    ->count();

                $orders_days->cancel = Orders::whereDate('created_at', $date_now)
                    ->where('status', 'Отменен')
                    ->count();

                $orders_days->save();
            } else {
                foreach ($orders_old as $item) {
                    $date = $item->date->format('Y-m-d');

                    $item->advertising = Costs::whereDate('date', $date)
                        ->where('name', 'Таргет')
                        ->select('total')
                        ->sum('total');

                    $item->applications = Orders::whereDate('created_at', $date)
                        ->count();

                    if ($item->applications > 0) {
                        $item->application_price = $item->advertising / $item->applications;
                    }else{
                        $item->application_price = '-';
                    }

                    $item->in_process = Orders::whereDate('created_at', $date)
                        ->where('status', 'В процессе')
                        ->count();

                    $item->transferred_to_supplier = Orders::whereDate('created_at', $date)
                        ->where('status', 'Передан поставщику')
                        ->count();

                    $item->at_the_post_office = Orders::whereDate('created_at', $date)
                        ->where('status', 'На почте')
                        ->count();

                    $item->completed_applications = Orders::whereDate('created_at', $date)
                        ->where('status', 'Выполнен')
                        ->count();

                    $item->unprocessed = Orders::whereDate('created_at', $date)
                        ->where('status', 'Новый')
                        ->count();

                    $item->refunds = Orders::whereDate('created_at', $date)
                        ->where('status', 'Возврат')
                        ->count();

                    $item->cancel = Orders::whereDate('created_at', $date)
                        ->where('status', 'Отменен')
                        ->count();

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
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
