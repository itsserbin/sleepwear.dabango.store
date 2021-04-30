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
            $date = Carbon::yesterday();

            $profit = new Profit();
            $profit->cost = $ProfitCost = Costs::where('updated_at', '>', $date)->select('total')->sum('total');
            $profit->profit = $ProfitProfit = Orders::where([
                ['updated_at', '>', $date],
                ['status', '=', 'Выполнен']
            ])->select('profit')->sum('profit');
            $profit->marginality = $ProfitProfit - $ProfitCost;
            $profit->turnover = $ProfitProfit + $ProfitCost;
            $profit->save();
        })->daily();
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
