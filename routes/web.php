<?php

use App\Http\Controllers\Account\DepositController;
use App\Http\Controllers\Account\StatementController;
use App\Http\Controllers\Account\TransferController;
use App\Http\Controllers\Account\WithdrawlController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Invoice\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


// Handle Auth Request
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::match(['post', 'put'], '/data/{id?}', [AdminController::class, 'handlePostRequest'])->name('handlePostRequest');

    Route::get('/data', [AdminController::class, 'handlegetRequest'])->name('handlegetRequest');

    Route::get('/customer/{id?}', [AdminController::class, 'createCustomer'])->name('createCustomer');
    Route::get('/invoice/{id?}', [AdminController::class, 'createInvoice'])->name('createInvoice');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});
