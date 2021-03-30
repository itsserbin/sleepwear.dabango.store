<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\HomeController;
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
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id?}', [HomeController::class, 'product'])->name('product');

Route::group(['middleware' => 'auth'],function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductsController::class)->names('admin.products');
    Route::post('img-upload', [ProductsController::class, 'store'])->name('uploads.photo.post');
});

require __DIR__.'/auth.php';
