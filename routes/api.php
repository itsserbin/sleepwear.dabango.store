<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/**
 * Группа маршрутов API для авторизованных пользователей.
 */
Route::middleware('auth:api')->group(function () {

    /**
     * Маршрут дашборда админ.панели.
     */
    Route::get('dashboard', [AdminController::class, 'dashboard'])
        ->name('api.dashboard');

    /**
     * Группа маршрутов для клиентского раздела.
     */
    Route::prefix('clients')->group(function () {

        /**
         * Получить всех клиентов.
         */
        Route::get('/', [ClientsController::class, 'index'])
            ->name('api.clients.index');

        /**
         * Поиск клиентов по базе
         */
        Route::post('/search/{search}', [ClientsController::class, 'search'])
            ->name('api.clients.search');

        /**
         * Удаление клиента по ID.
         */
        Route::delete('/destroy/{id}', [ClientsController::class, 'destroy'])
            ->name('api.clients.destroy');
    });

    /**
     * Группа маршрутов для заказов.
     */
    Route::prefix('orders')->group(function () {

        /**
         * Получить все заказы.
         */
        Route::get('/', [OrdersController::class, 'index'])
            ->name('api.orders.index');

        /**
         * Поиск клиентов по базе
         */
        Route::post('/search/{search}', [OrdersController::class, 'search'])
            ->name('api.orders.search');

        /**
         * Удаление заказ по ID.
         */
        Route::delete('/destroy/{id}', [OrdersController::class, 'destroy'])
            ->name('api.orders.destroy');
    });

});
