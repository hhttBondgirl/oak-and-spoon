<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

// トップページ（メニュー一覧）
Route::get('/', [OrderController::class, 'index'])->name('orders.index');

// 注文確認（メニューから POST → セッション保存後 GET で表示）
Route::get('/confirm', [OrderController::class, 'confirmShow'])->name('orders.confirm.show');
Route::post('/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');

// 注文確定
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// メニュー詳細画面
Route::get('/menus/{menu}', [OrderController::class, 'show'])->name('orders.show');
