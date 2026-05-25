<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'pages.index');

Route::middleware('auth')
->prefix('user/')
->name('user.')
->group(function(){

Volt::route('dashboard', 'pages.dashboard')
    ->name('dashboard');


    Volt::route('deposit','pages.deposit.index')
    ->name('deposit.create');

    Volt::route('investment_plans/buy','pages.plans.index')
    ->name('investment_plans.buy');


    Volt::route('withdraw','pages.withdraw.index')
    ->name('withdraw.create');

});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';
