<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('/feature', [PageController::class, 'feature'])->name('feature');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/bookings', [UserDashboardController::class, 'bookings'])->name('bookings');

    Route::get('/user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/services/{logisticsService}/order', [UserDashboardController::class, 'createOrder'])->name('user.orders.create');
    Route::post('/user/service-orders', [UserDashboardController::class, 'storeOrder'])->name('user.orders.store');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
        Route::patch('/services/{logisticsService}', [AdminController::class, 'updateService'])->name('services.update');
        Route::delete('/services/{logisticsService}', [AdminController::class, 'destroyService'])->name('services.destroy');
        Route::patch('/service-orders/{serviceOrder}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');
    });
});

Route::redirect('/index', '/');
Route::redirect('/index.html', '/');
Route::redirect('/about.html', '/about');
Route::redirect('/service.html', '/service');
Route::redirect('/feature.html', '/feature');
Route::redirect('/quote', '/bookings');
Route::redirect('/quote.html', '/bookings');
Route::redirect('/booking', '/bookings');
Route::redirect('/contact.html', '/contact');
