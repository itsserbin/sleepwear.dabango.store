<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
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
Route::post('send-form', [HomeController::class, 'sendForm'])->name('send.form');
Route::post('send-review', [HomeController::class, 'sendReview'])->name('send.review');

Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('products', ProductsController::class)->names('admin.products');

    Route::group(['prefix' => '/reviews'], function () {
        Route::resource('all', ReviewsController::class)->names('admin.reviews');
        Route::get('accepted/{id}', [ReviewsController::class, 'reviewsAccepted'])->where('id', '\d+')->name('review.accepted');
    });

    Route::group(['prefix' => '/clients'], function () {
        Route::resource('all', ClientsController::class)->names('admin.clients');
    });

    Route::group(['prefix' => '/orders'], function () {
        Route::resource('all', OrdersController::class)->names('admin.orders');
        Route::get('new', [OrdersController::class, 'showNewOrders'])->name('admin.orders.showNewOrders');
        Route::get('done', [OrdersController::class, 'showDoneOrders'])->name('admin.orders.showDoneOrders');
        Route::get('cancel', [OrdersController::class, 'showCancelOrders'])->name('admin.orders.showCancelOrders');
        Route::get('process', [OrdersController::class, 'showProcessOrders'])->name('admin.orders.showProcessOrders');
        Route::get('return', [OrdersController::class, 'showReturnOrders'])->name('admin.orders.showReturnOrders');
        Route::get('post-office', [OrdersController::class, 'showPostOfficeOrders'])->name('admin.orders.showPostOfficeOrders');
        Route::get('transferred-to-supplier-orders', [OrdersController::class, 'showTransferredToSupplierOrders'])->name('admin.orders.showTransferredToSupplierOrders');
    });

    Route::group(['middleware' => 'role:administrator', 'prefix' => '/bookkeeping'], function () {
        Route::resource('all', App\Http\Controllers\Bookkeeping\BookkeepingController::class)->names('admin.bookkeeping');
        Route::resource('costs', App\Http\Controllers\Bookkeeping\CostsController::class)->names('admin.bookkeeping.costs');
        Route::resource('profit', App\Http\Controllers\Bookkeeping\ProfitController::class)->names('admin.bookkeeping.profit');
    });

    Route::group(['middleware' => 'role:administrator', 'prefix' => '/settings'], function () {
        Route::resource('all', SettingsController::class)->names('admin.settings');
        Route::get('scripts', [SettingsController::class, 'scripts'])->name('admin.settings.scripts');
        Route::resource('colors', ColorsController::class)->names('admin.settings.colors');
        Route::post('save', [SettingsController::class, 'save'])->name('admin.settings.save');
        Route::resource('users', UsersController::class)->names('admin.users');
        Route::resource('roles', \App\Http\Controllers\Admin\RolesColroller::class)->names('admin.roles');
    });

    Route::post('img-upload', [ProductsController::class, 'store'])->name('uploads.photo.post');
    Route::post('del-img', [ProductsController::class, 'destroyImage'])->name('destroy.image');
});

require __DIR__ . '/auth.php';
