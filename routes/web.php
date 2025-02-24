<?php

use App\Http\Middleware\guestonly;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyClient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::group(['middleware' => guestonly::class], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registering']);
});

Route::middleware('auth')->group(function () {

    Route::group(['middleware' => OnlyAdmin::class], function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('books', [BookController::class, 'book']);
        Route::get('create-book', [BookController::class, 'create']);
        Route::post('create-book', [BookController::class, 'store']);
        Route::delete('book-delete/{slug}', [BookController::class, 'destroy']);
        Route::get('book-edit/{slug}', [BookController::class, 'edit']);
        Route::put('book-edit/{slug}', [BookController::class, 'update']);
        Route::delete('book-delete/{slug}', [BookController::class, 'destroy']);

        Route::get('categories', [CategoriesController::class, 'index']);
        Route::get('create-category', [CategoriesController::class, 'create']);
        Route::post('create-category', [CategoriesController::class, 'store']);
        Route::delete('category-delete/{slug}', [CategoriesController::class, 'destroy']);
        Route::get('category-edit/{slug}', [CategoriesController::class, 'edit']);
        Route::put('category-edit/{slug}', [CategoriesController::class, 'update']);
        Route::get('users', [UserController::class, 'index']);
        Route::delete('user-delete/{slug}', [UserController::class, 'destroy']);
        Route::get('user-edit/{slug}', [UserController::class, 'edit']);
        Route::put('user-edit/{slug}', [UserController::class, 'update']);
        Route::get('user-detail/{slug}', [UserController::class, 'detail']);
        Route::put('user-updatestatus/{slug}', [UserController::class, 'updateStatus']);
        Route::get('user-inactive', [UserController::class, 'inactive']);
        Route::get('rentlog', [RentlogController::class, 'index']);

        Route::get('/admin/rent-logs', [RentLogController::class, 'index'])->name('admin.rentlogs');
        Route::post('/admin/rent-logs/{rentLog}/confirm', [RentLogController::class, 'confirm'])->name('admin.rentlogs.confirm');
        Route::post('admin/rentlogs/{id}/returned', [RentLogController::class, 'returned'])->name('admin.rentlogs.returned');
    });

    Route::get('/rent-receipt/{rentLog}', [RentLogController::class, 'receipt'])->name('rent.receipt');

    Route::get('/borrow/{book}', [RentLogController::class, 'create'])->name('borrow.create');
    Route::post('/borrow', [RentLogController::class, 'store'])->name('borrow.store');

    Route::get('logout', [AuthController::class, 'logout']);
    Route::group(['middleware' => OnlyClient::class], function () {

        Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware(OnlyClient::class);
        Route::get('user-edit/{slug}', [UserController::class, 'edit']);
        Route::put('user-edit/{slug}', [UserController::class, 'update']);
        Route::get('/dashboard-user', [UserController::class, 'dashboard']);
    });
});
