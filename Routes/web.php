<?php 

use App\Http\Controllers\SubscriptionController;

Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
Route::get('/subscriptions/renew/{pk}', [SubscriptionController::class, 'renew'])->name('subscriptions.renew');
Route::get('/subscriptions/gopro/{pk}', [SubscriptionController::class, 'gopro'])->name('subscriptions.gopro');
Route::get('/subscriptions/upgrade/{pk}', [SubscriptionController::class, 'upgrade'])->name('subscriptions.upgrade');
