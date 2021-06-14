<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\RolesColroller;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Bookkeeping\BookkeepingController;
use App\Http\Controllers\Bookkeeping\DailyStatisticsController;
use App\Http\Controllers\Bookkeeping\ProductStatisticsController;
use App\Http\Controllers\Bookkeeping\ProvidersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id?}', [HomeController::class, 'product'])->name('product');

Route::post('send-form', [HomeController::class, 'send_form_post'])->name('send.form.post');
Route::get('send-form', [HomeController::class, 'send_form_get'])->name('send.form.get');
Route::post('send-review', [HomeController::class, 'send_review_post'])->name('send.review.post');
//Route::get('send-review', [HomeController::class, 'send_review_get'])->name('send.review.get');


Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('products', ProductsController::class)->names('admin.products');

    Route::resource('reviews', ReviewsController::class)->names('admin.reviews');
    Route::get('reviews-accepted/{id}', [ReviewsController::class, 'reviewsAccepted'])->where('id', '\d+')->name('review.accepted');

    Route::group(['prefix' => '/clients'], function () {
        Route::get('/', [ClientsController::class, 'index'])
            ->name('admin.clients.index');

        Route::get('/edit/{id}', [ClientsController::class, 'edit'])
            ->name('admin.clients.edit');

        Route::patch('/update/{id}', [ClientsController::class, 'update'])
            ->name('admin.clients.update');

        Route::delete('/destroy/{id}', [OrdersController::class, 'destroy'])
            ->name('admin.clients.destroy');


//        Route::resource('all', ClientsController::class)->names('admin.clients');
    });

    Route::group(['prefix' => '/orders'], function () {
        Route::get('/', [OrdersController::class, 'index'])->name('admin.orders.index');
        Route::get('/edit/{id}', [OrdersController::class, 'edit'])->name('admin.orders.edit');
        Route::patch('/update/{id}', [OrdersController::class, 'update'])->name('admin.orders.update');
        Route::delete('/destroy/{id}', [OrdersController::class, 'destroy'])->name('admin.orders.destroy');

        Route::get('new', [OrdersController::class, 'showNewOrders'])->name('admin.orders.showNewOrders');
        Route::get('done', [OrdersController::class, 'showDoneOrders'])->name('admin.orders.showDoneOrders');
        Route::get('cancel', [OrdersController::class, 'showCancelOrders'])->name('admin.orders.showCancelOrders');
        Route::get('process', [OrdersController::class, 'showProcessOrders'])->name('admin.orders.showProcessOrders');
        Route::get('return', [OrdersController::class, 'showReturnOrders'])->name('admin.orders.showReturnOrders');
        Route::get('post-office', [OrdersController::class, 'showPostOfficeOrders'])->name('admin.orders.showPostOfficeOrders');
        Route::get('transferred-to-supplier-orders', [OrdersController::class, 'showTransferredToSupplierOrders'])->name('admin.orders.showTransferredToSupplierOrders');
    });

    Route::group(['middleware' => 'role:administrator', 'prefix' => '/bookkeeping'], function () {
        Route::resource('all', App\Http\Controllers\Bookkeeping\BookkeepingController::class)
            ->names('admin.bookkeeping');

        Route::resource('costs', App\Http\Controllers\Bookkeeping\CostsController::class)
            ->names('admin.bookkeeping.costs');

        Route::resource('profit', App\Http\Controllers\Bookkeeping\ProfitController::class)
            ->names('admin.bookkeeping.profit');

//        Route::resource('daily-statistics', DailyStatisticsController::class)
//            ->names('admin.bookkeeping.daily-statistics');

        Route::prefix('daily-statistics')->group(function () {
            Route::get('/', [DailyStatisticsController::class, 'index'])
                ->name('admin.bookkeeping.daily-statistics.index');

            Route::get('create', [DailyStatisticsController::class, 'create'])
                ->name('admin.bookkeeping.daily-statistics.create');

            Route::post('store', [DailyStatisticsController::class, 'store'])
                ->name('admin.bookkeeping.daily-statistics.store');

            Route::delete('destroy/{id}', [DailyStatisticsController::class, 'destroy'])
                ->name('admin.bookkeeping.daily-statistics.destroy');

            Route::get('days=7', [DailyStatisticsController::class, 'showStatisticsFor7Days'])
                ->name('admin.bookkeeping.daily-statistics.7Days');

            Route::get('days=14', [DailyStatisticsController::class, 'showStatisticsFor14Days'])
                ->name('admin.bookkeeping.daily-statistics.week');

            Route::get('days=30', [DailyStatisticsController::class, 'showStatisticsFor30Days'])
                ->name('admin.bookkeeping.daily-statistics.30Days');

            Route::post('date-range', [DailyStatisticsController::class, 'showFromRange'])
                ->name('admin.bookkeeping.daily-statistics.dateRange');
        });


        Route::resource('product-statistics', ProductStatisticsController::class)
            ->names('admin.bookkeeping.product-statistics');

        Route::resource('providers', ProvidersController::class)
            ->names('admin.bookkeeping.providers');
    });

    Route::group(['middleware' => 'role:administrator', 'prefix' => '/options'], function () {
        Route::get('/', [OptionsController::class, 'index'])->name('admin.options.index');
        Route::get('scripts', [OptionsController::class, 'scripts'])->name('admin.options.scripts');
        Route::resource('colors', ColorsController::class)->names('admin.options.colors');
        Route::post('update', [OptionsController::class, 'update'])->name('admin.options.update');
        Route::resource('users', UsersController::class)->names('admin.users');
        Route::resource('roles', RolesColroller::class)->names('admin.roles');
    });

    Route::post('img-upload', [ProductsController::class, 'store'])->name('uploads.photo.post');
    Route::post('del-img', [ProductsController::class, 'destroyImage'])->name('destroy.image');
});

Auth::routes();
