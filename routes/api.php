<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\Bookkeeping\DailyStatisticsController;
use App\Http\Controllers\Api\Bookkeeping\SupplierPaymentsController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\OrderItemsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\UploadController;
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

/** Группа маршрутов API для авторизованных пользователей. */
Route::middleware('auth:api')->group(function () {

    /**
     * Маршрут дашборда админ.панели.
     *
     * GET /api/dashboard
     */
    Route::get('dashboard', [AdminController::class, 'dashboard'])
        ->name('api.dashboard');

    /** Группа маршрутов для клиентского раздела */
    Route::prefix('clients')->group(function () {

        /**
         * Получить всех клиентов.
         *
         * GET /api/clients
         */
        Route::get('/', [ClientsController::class, 'index'])
            ->name('api.clients.index');

        /**
         * Поиск клиентов по базе
         *
         * POST /api/clients/search/{search}
         */
        Route::post('/search/{search}', [ClientsController::class, 'search'])
            ->name('api.clients.search');

        /**
         * Удаление клиента по ID.
         *
         * DELETE /api/clients/destroy/{id}
         */
        Route::delete('/destroy/{id}', [ClientsController::class, 'destroy'])
            ->name('api.clients.destroy');
    });

    /** Группа маршрутов для заказов */
    Route::prefix('orders')->group(function () {

        /**
         * Получить все заказы.
         *
         * GET /api/orders
         */
        Route::get('/', [OrdersController::class, 'index'])
            ->name('api.orders.index');

        /**
         * Поиск клиентов по базе
         *
         * POST /api/orders/search/{search}
         */
        Route::post('/search/{search}', [OrdersController::class, 'search'])
            ->name('api.orders.search');

        /**
         * Удаление заказ по ID.
         *
         * DELETE /api/orders/destroy/{id}
         */
        Route::delete('/destroy/{id}', [OrdersController::class, 'destroy'])
            ->name('api.orders.destroy');

        /**
         * Получить заказ по ID для редактирования.
         *
         * GET /api/orders/edit/{id}
         */
        Route::get('/edit/{id}', [OrdersController::class, 'edit'])
            ->name('api.orders.edit');

        /**
         * Обновить заказ по ID.
         *
         * PUT /api/orders/update/{id}
         */
        Route::put('/update/{id}', [OrdersController::class, 'update'])
            ->name('api.orders.update');
    });

    /** Группа маршрутов для элементов заказа */
    Route::prefix('order-items')->group(function () {

        /**
         * Получить элементы по ID заказа.
         *
         * GET /api/order-items/{id}
         */
        Route::get('{id}', [OrderItemsController::class, 'getByOrderId'])
            ->name('api.order-items.getByOrderId');

        /**
         * Удаление элемента заказа по ID.
         *
         * DELETE /api/order-items/destroy/{id}
         */
        Route::delete('destroy/{id}', [OrderItemsController::class, 'destroy'])
            ->name('api.order-items.destroy');

        /**
         * Обновить данные элемента заказа.
         *
         * PUT /api/order-items/update/{id}
         */
        Route::put('/update/{id}', [OrderItemsController::class, 'update'])
            ->name('api.order-items.update');

        /**
         * Обноить статус выплаты.
         *
         * PUT /api/order-items/update-pay-status/{id}
         */
        Route::put('/update-pay-status/{id}', [OrderItemsController::class, 'updatePayStatus'])
            ->name('api.order-items.update-pay-status');

        /**
         * Получить элемент заказа для редактирования.
         *
         * GET /api/order-items/edit/{id}
         */
        Route::get('/edit/{id}', [OrderItemsController::class, 'edit'])
            ->name('api.order-items.edit');
    });

    /** Группа маршрутов для бухгалтерии */
    Route::prefix('bookkeeping')->group(function () {

        Route::prefix('daily-statistics')->group(function () {

            /**
             * Получить всю статистику по дням.
             *
             * GET /api/bookkeeping/daily-statistics
             */
            Route::get('/', [DailyStatisticsController::class, 'index'])
                ->name('api.bookkeeping.daily_statistics.index');

            /**
             * Добавить новую дату в статистику.
             *
             * GET /api/bookkeeping/daily-statistics/create
             */
            Route::get('create', [DailyStatisticsController::class, 'create'])
                ->name('api.bookkeeping.daily_statistics.create');

            /**
             * Сортировать статистику по диапазону дат.
             *
             * GET /api/bookkeeping/daily-statistics/date-range
             */
            Route::get('date-range', [DailyStatisticsController::class, 'dateRange'])
                ->name('api.bookkeeping.daily_statistics.dateRange');

        });

        /** Группа маршрутов для страницы с информацией о выплатах. */
        Route::prefix('supplier-payments')->group(function () {

            /**
             * Получить все заказы, ожидающие выплаты.
             *
             * GET /api/bookkeeping/supplier-payments
             */
            Route::get('/', [SupplierPaymentsController::class, 'index'])
                ->name('api.bookkeeping.supplier-payments.index');

            /**
             * Получить все заказы, ожидающие выплаты от поставщика.
             *
             * GET /api/bookkeeping/supplier-payments/payments-awaiting
             */
            Route::get('payments-awaiting', [SupplierPaymentsController::class, 'paymentsAwaiting'])
                ->name('api.bookkeeping.supplier-payments.paymentsAwaiting');

            /**
             * Получить все заказы, ожидающие выплаты от поставщика.
             *
             * GET /api/bookkeeping/supplier-payments/payments-received
             */
            Route::get('payments-received', [SupplierPaymentsController::class, 'paymentsReceived'])
                ->name('api.bookkeeping.supplier-payments.paymentsReceived');
        });
    });

    /** Группа маршрутов для категорий в аодминке */
    Route::prefix('categories')->group(function () {

        /**
         * Получить список всех категорий в пагинации
         *
         * GET /api/categories
         */
        Route::get('/', [CategoriesController::class, 'index'])
            ->name('api.categories.index');

        /**
         * Получить список всех категорий
         *
         * GET /api/categories/all
         */
        Route::get('all', [CategoriesController::class, 'all'])
            ->name('api.categories.all');

        /**
         * Создать новую категорию.
         *
         * POST /api/categories/create
         */
        Route::post('create', [CategoriesController::class, 'create'])
            ->name('api.categories.create');

        /**
         * Открыть страницу редактирования категории.
         *
         * GET /api/categories/edit/{id}
         */
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])
            ->name('api.categories.edit');

        /**
         * Обновить данные категории.
         *
         * PUT /api/categories/update/{id}
         */
        Route::put('update/{id}', [CategoriesController::class, 'update'])
            ->name('api.categories.update');

        /**
         * Удалить категорию.
         *
         * DELETE /api/categories/destroy/{id}
         */
        Route::delete('destroy/{id}', [CategoriesController::class, 'destroy'])
            ->name('api.categories.destroy');
    });

    /** Группа маргрутов для изображений */
    Route::prefix('images')->group(function () {

        /** Группа маршрутов для превью */
        Route::prefix('preview-update')->group(function () {

            /**
             * Загрузить превью для категорий.
             *
             * POST /api/images/preview-update/categories
             */
            Route::post('categories', [UploadController::class, 'uploadCategoryPreview'])
                ->name('api.images.upload.preview');
        });
    });
});

/** Группа маршрутов API для неавторизованных пользователей */
Route::middleware('api')->group(function () {

    /** Группа маршрутов для товаров */
    Route::prefix('product')->group(function () {

        /**
         * Вывести все товары в пагинации.
         *
         * GET /api/product
         */
        Route::get('/', [ProductsController::class, 'index'])
            ->name('api.product.index');

        /**
         * Получить товар по ID.
         *
         * GET /api/product/show/{id}
         */
        Route::get('show/{id}', [ProductsController::class, 'showProductApi'])
            ->name('api.products.show');

        /**
         * Получить цвета по ID товара.
         *
         * GET /api/product/colors/{id}
         */
        Route::get('colors/{id}', [ProductsController::class, 'showProductColorsApi'])
            ->name('api.product.colors.show');
    });

    /** Группа маршрутов для корзины */
    Route::prefix('cart')->group(function () {

        /**
         * Показать товары в корзину.
         *
         * GET /api/cart/list
         */
        Route::get('list', [CartController::class, 'list'])
            ->name('api.cart.list');

        /**
         * Добавить товар в корзину.
         *
         * POST /api/cart/add
         */
        Route::post('add', [CartController::class, 'add'])
            ->name('api.cart.add');

        /**
         * Удалить товар из корзины.
         *
         * DELETE /api/cart/delete/{item}
         */
        Route::delete('delete/{item}', [CartController::class, 'delete'])
            ->name('api.cart.delete');

        /**
         * Обновить инфу в корзине.
         *
         * POST /api/cart/update/
         */
        Route::post('update', [CartController::class, 'update'])
            ->name('api.cart.update');
    });

    /** Группа маршрутов для заказов */
    Route::prefix('order')->group(function () {

        /**
         * Создание нового заказа.
         *
         * POST /api/order/create
         */
        Route::post('create', [OrdersController::class, 'create'])
            ->name('api.orders.create');
    });

    /** Группа маршрутов для категорий */
    Route::prefix('category')->group(function () {

        /**
         * Получить категории для вывода на продакшн.
         *
         * GET /api/category/all-on-prod
         */
        Route::get('all-on-prod', [CategoriesController::class, 'getAllOnProd'])
            ->name('api.category.getAllOnProd');

        /**
         * Получить отдельную категорию.
         *
         * GET /api/category/{slug}
         */
        Route::get('{slug}', [CategoriesController::class, 'getCategoryOnProduction'])
            ->name('api.category.getCategoryOnProduction');

        /**
         * Получить товары из определенной категории..
         *
         * GET /api/category/products/{slug}
         */
        Route::get('products/{slug}', [CategoriesController::class, 'getCategoryProductsOnProduction'])
            ->name('api.category.getCategoryProductsOnProduction');
    });
});
