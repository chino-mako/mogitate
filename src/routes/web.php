<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // 商品一覧
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search'); // 検索
Route::get('/products/register', [ProductController::class, 'create'])->name('products.create'); // 商品登録フォーム
Route::post('/products/register', [ProductController::class, 'store'])->name('products.store'); // 商品登録処理
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show'); // 商品詳細
Route::put('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update'); // 更新処理
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.delete'); // 商品削除


