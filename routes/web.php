<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\BidAcceptanceController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\DomainController;

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
});

Route::post('/domains/{domain}/bids', [BidController::class, 'store'])->name('bids.store');
Route::get('/bids/{bid}/accept/{token}', [BidAcceptanceController::class, 'showAccept'])->name('bids.accept');
Route::post('/bids/{bid}/accept/{token}', [BidAcceptanceController::class, 'processAccept'])->name('bids.accept.process');
Route::post('/webhooks/mollie', [WebhookController::class,'handle'])->name('webhooks.mollie');
Route::get('/domains', [DomainController::class, 'index'])
     ->middleware(['auth'])
     ->name('domains.index');

require __DIR__.'/auth.php';
