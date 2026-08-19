<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController as Bill;
use App\Http\Controllers\AccountChartController as coaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Chart of Accounts routes
    Route::get('/chart-of-accounts', [coaController::class, 'coa'])->name('chart-of-accounts');
    Route::post('/chart-of-accounts', [coaController::class, 'store'])->name('chart-of-accounts.store');
    // AJAX: Get next available code
    Route::post('/api/accounts/next-code', [coaController::class, 'getNextCode'])->name('api.accounts.next-code');

    // AJAX routes for cascading dropdowns
    Route::get('/api/accounts/top-level', [coaController::class, 'getTopLevel'])->name('api.accounts.top-level');
    Route::get('/api/accounts/{account}/children', [coaController::class, 'getChildren'])->name('api.accounts.children');

    Route::get('/transactions/bill/dashboard', [Bill::class, 'dashboard'])
        ->name('transactions.bill.dashboard');

    Route::get('/transactions/bill/create', [Bill::class, 'create'])
        ->name('transactions.bill.create');

    Route::post('/transactions/bill', [Bill::class, 'store'])
        ->name('transactions.bill.store');
});










require __DIR__ . '/auth.php';
