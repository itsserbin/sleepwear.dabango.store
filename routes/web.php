<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoriesController;
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
use App\Http\Controllers\Bookkeeping\SupplierPaymentsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

/**
 * Открыть главную страницу.
 *
 * GET /
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/**
 * Открыть корзину.
 *
 * GET /cart/
 */
Route::get('cart', [CartController::class, 'index'])
    ->name('cart');

/**
 * Открыть страницу подтверждения заказа.
 */
Route::get('checkout', [HomeController::class, 'checkout'])
    ->name('checkout');

/**
 * Открыть страницу товара.
 *
 * GET /product/{id}
 */
Route::get('/product/{id?}', [HomeController::class, 'product'])
    ->name('product');

/**
 * Открыть страницу категории.
 *
 * GET /category/{slug}
 */
Route::get('/category/{slug}', [HomeController::class, 'category'])
    ->name('category');

/**
 * Открыть политику конфеденциальности
 *
 * GET /privacy-policy
 */
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])
    ->name('privacy-policy');

/**
 * Открыть карту сайта XML
 *
 * GET /sitemap
 */
Route::get('sitemap.xml', [HomeController::class, 'sitemap'])
    ->name('sitemap');

/**
 * Открыть товарный фид для фейсбука.
 *
 * GET /xml/fb/feed/products
 */
Route::get('xml/fb/feed/products', [HomeController::class, 'fbProductFeed'])
    ->name('fb.product.feed');

/**
 * Открыть товарный фид для prom.ua.
 *
 * GET /xml/prom/feed/products
 */
Route::get('xml/prom/feed/products', [HomeController::class, 'promProductFeed'])
    ->name('prom.product.feed');

/**
 * Показать страницу благодарности после отправки заявки.
 *
 * GET /send-form
 */
Route::get('send-form', [HomeController::class, 'send_form_get'])
    ->name('send.form.get');

/**
 * Отправить форму отзыва.
 *
 * POST /send-review/
 */
Route::post('send-review', [HomeController::class, 'send_review_post'])
    ->name('send.review.post');


/** Группа маршрутов для админ.панели */
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    /**
     * Открыть главную страницу админки.
     *
     * GET /admin/dashboard
     */
    Route::get('dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    /** Группа маршрутов для картегорий */
    Route::prefix('categories')->group(function () {

        /**
         * Открыть страницу со всеми категориями.
         *
         * GET /admin/categories
         */
        Route::get('/', [CategoriesController::class, 'index'])
            ->name('admin.categories.index');

        /**
         * Открыть страницу создания категории.
         *
         * GET /admin/categories/create
         */
        Route::get('create', [CategoriesController::class, 'create'])
            ->name('admin.categories.create');

        /**
         * Открыть страницу редактирования категории.
         *
         * GET /admin/categories/edit
         */
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])
            ->name('admin.categories.edit');
    });

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


        Route::prefix('daily-statistics')->group(function () {
            Route::get('/', [DailyStatisticsController::class, 'index'])
                ->name('admin.bookkeeping.daily-statistics.index');

            Route::get('create', [DailyStatisticsController::class, 'create'])
                ->name('admin.bookkeeping.daily-statistics.create');

            Route::post('store', [DailyStatisticsController::class, 'store'])
                ->name('admin.bookkeeping.daily-statistics.store');

            Route::delete('destroy/{id}', [DailyStatisticsController::class, 'destroy'])
                ->name('admin.bookkeeping.daily-statistics.destroy');
        });


        Route::resource('product-statistics', ProductStatisticsController::class)
            ->names('admin.bookkeeping.product-statistics');

        Route::resource('providers', ProvidersController::class)
            ->names('admin.bookkeeping.providers');

        Route::get('supplier-payments', [SupplierPaymentsController::class, 'index'])
            ->name('admin.bookkeeping.supplier-payments.index');
    });

    Route::group(['middleware' => 'role:administrator', 'prefix' => '/options'], function () {
        Route::get('/', [OptionsController::class, 'index'])->name('admin.options.index');
        Route::get('scripts', [OptionsController::class, 'scripts'])->name('admin.options.scripts');
        Route::resource('colors', ColorsController::class)->names('admin.options.colors');
        Route::post('update/{id}', [OptionsController::class, 'update'])->name('admin.options.update');
        Route::resource('users', UsersController::class)->names('admin.users');
        Route::resource('roles', RolesColroller::class)->names('admin.roles');
    });

    Route::post('img-upload', [ProductsController::class, 'store'])->name('uploads.photo.post');
    Route::post('del-img', [ProductsController::class, 'destroyImage'])->name('destroy.image');
});

Auth::routes();
