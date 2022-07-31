<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/Configuración', 'profile.show')->name('user.config');

Route::get('/Compras', function () {
    return view('purchases');
})->name('purchases');

Route::get('/billing-portal', function (Request $request) {
    return $request->user()->redirectToBillingPortal(route('home'));
})->name('billing-portal');