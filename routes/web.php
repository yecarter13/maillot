<?php

use App\Http\Controllers\Admin\ChampionshipController;
use App\Http\Controllers\Admin\CustomerPhotoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/uploads/products/{file}', function (string $file) {
    $path = dirname(base_path()) . '/uploads/products/' . basename($file);
    if (!is_file($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('file', '.*')->name('uploads.products');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/suggest', [ShopController::class, 'suggest'])->name('shop.suggest');
Route::get('/championnat/{championship}', [ShopController::class, 'index'])->name('shop.championship');
Route::get('/maillot/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/phototheque', [GalleryController::class, 'index'])->name('gallery.index');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::post('products/{product}/toggle', [AdminProductController::class, 'toggle'])->name('products.toggle');
    Route::resource('championships', ChampionshipController::class);
    Route::post('championships/{championship}/toggle', [ChampionshipController::class, 'toggle'])->name('championships.toggle');
    Route::resource('users', UserController::class);
    Route::resource('customer-photos', CustomerPhotoController::class);
    Route::post('customer-photos/{photo}/toggle', [CustomerPhotoController::class, 'toggle'])->name('customer-photos.toggle');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
