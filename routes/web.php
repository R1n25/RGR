<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PartController as AdminPartController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Каталог запчастей
Route::prefix('catalog')->group(function () {
    Route::get('/', [PartController::class, 'index'])->name('parts.index');
    Route::get('/{part}', [PartController::class, 'show'])->name('parts.show');
    Route::get('/category/{category}', [PartController::class, 'category'])->name('parts.category');
    Route::get('/brand/{brand}', [PartController::class, 'brand'])->name('parts.brand');
    Route::post('/search', [PartController::class, 'search'])->name('parts.search');
});

// Корзина
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
});

// Заказы
Route::prefix('orders')->group(function () {
    Route::post('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/success/{order}', [OrderController::class, 'success'])->name('orders.success');
});

// API для получения моделей по бренду
Route::get('/api/models/{brand}', [PartController::class, 'getModels'])->name('api.models');

// Информационные страницы
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contacts', function () {
    return view('pages.contacts');
})->name('contacts');

Route::get('/delivery', function () {
    return view('pages.delivery');
})->name('delivery');

// Схема проезда
Route::get('/map', [PageController::class, 'map'])->name('map');

// Аутентификация
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Админ-панель
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Управление каталогом
    Route::resource('categories', AdminCategoryController::class)->names('admin.categories');
    Route::resource('parts', AdminPartController::class)->names('admin.parts');
    Route::resource('brands', AdminBrandController::class)->names('admin.brands');
    
    // Управление заказами
    Route::resource('orders', AdminOrderController::class)->names('admin.orders');
    Route::post('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');
    
    // Настройки
    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
