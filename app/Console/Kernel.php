<?php

namespace App\Console;

use App\Models\Bookkeeping\Costs;
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
            $date = Carbon::now()->format('Y-m-d');
            $profit = Profit::whereDate('created_at',$date)->get();
            $profit_old = Profit::whereDate('created_at','<', $date)->get();

            foreach ($profit_old as $item){
                $created_at = $item->created_at->format('Y-m-d');
                $item->profit = $ProfitProfit = Orders::whereDate('created_at',$created_at)
                    ->where('status','Выполнен')
                    ->select('profit')
                    ->sum('profit');

                $item->cost = $ProfitCost = Costs::whereDate('created_at', $created_at)
                    ->select('total')
                    ->sum('total');
                $item->marginality = $ProfitProfit - $ProfitCost;
                $item->turnover = $ProfitProfit + $ProfitCost;
                $item->update();
            }

            if (count($profit)){
                foreach ($profit as $item){
                    $item->profit = $ProfitProfit = Orders::whereDate('created_at', $date)
                        ->where('status', 'Выполнен')
                        ->select('profit')
                        ->sum('profit');

                    $item->cost = $ProfitCost = Costs::whereDate('created_at', $date)
                        ->select('total')
                        ->sum('total');
                    $item->marginality = $ProfitProfit - $ProfitCost;
                    $item->turnover = $ProfitProfit + $ProfitCost;
                    $item->update();
                }
            }else{
                $profit = new Profit();
                $profit->cost = $ProfitCost = Costs::whereDate('created_at', $date)
                    ->select('total')
                    ->sum('total');

                $profit->profit = $ProfitProfit = Orders::whereDate('created_at', $date)
                    ->where('status', 'Выполнен')
                    ->select('profit')
                    ->sum('profit');

                $profit->marginality = $ProfitProfit - $ProfitCost;
                $profit->turnover = $ProfitProfit + $ProfitCost;
                $profit->save();;
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
