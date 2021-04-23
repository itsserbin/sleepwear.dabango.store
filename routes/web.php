<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::get('/token', function (Request $request) {
//    $token = $request->session()->token();
//    $token = csrf_token();
//});

Route::group(['middleware' => 'auth'],function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductsController::class)->names('admin.products');
    Route::resource('clients', ClientsController::class)->names('admin.clients');
    Route::resource('reviews', ReviewsController::class)->names('admin.reviews');
    Route::get('review-accepted/{id}', [ReviewsController::class, 'reviewsAccepted'])
        ->where('id', '\d+')
        ->name('review.accepted');
    Route::post('img-upload', [ProductsController::class, 'store'])->name('uploads.photo.post');
    Route::post('del-img', [ProductsController::class, 'destroyImage'])->name('destroy.image');
});

require __DIR__.'/auth.php';
