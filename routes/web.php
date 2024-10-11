<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckAge;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('home');
})->Middleware('auth');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

Route::group(['prefix' => 'customer', 'middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'home'])->name('home');
});

Route::prefix('/auth')->group(function () {

    Route::get('/verify/{email}', [AuthController::class, 'verify'])->name('verify');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])
        ->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
        ->name('reset-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('reset-password.post');
});
