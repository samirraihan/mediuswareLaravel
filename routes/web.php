<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'create'])->name('users.create');
    Route::post('/users', [RegisteredUserController::class, 'store'])->name('users.store');
});

Route::middleware('auth')->group(function () {
    // transactions
    Route::get('/dashboard', [TransactionController::class, 'index'])->name('dashboard');
    // deposit
    Route::get('/deposit', [TransactionController::class, 'depositCreate'])->name('deposit.create');
    Route::post('/deposit', [TransactionController::class, 'depositeStore'])->name('deposit.store');
    // withdraw
    Route::get('/withdraw', [TransactionController::class, 'withdrawCreate'])->name('withdraw.create');
    Route::post('/withdraw', [TransactionController::class, 'withdrawStore'])->name('withdraw.store');
});

require __DIR__ . '/auth.php';
