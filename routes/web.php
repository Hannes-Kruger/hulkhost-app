<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'onboarding',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/onboarding', \App\Livewire\Pages\Onboarding::class)->name('onboarding');

    Route::get('/invoices', \App\Livewire\Pages\Invoices::class)->name('invoices');
    Route::get('/payment-details', \App\Livewire\Pages\PaymentDetails::class)->name('payment-details');

    Route::get('/aws-accounts', \App\Livewire\Pages\AwsAccounts::class)->name('aws-accounts');

});
