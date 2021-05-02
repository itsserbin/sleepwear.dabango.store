<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('logs:clear', function() {

    // Option 1. Empty the laravel.log file, OR
    exec('echo "" > ' . storage_path('logs/laravel.log'));

    // Option 2. Empty the logs folder
    exec('rm ' . storage_path('logs/*'));

    $this->comment('Logs have been cleared!');

})->describe('Clear log files');
